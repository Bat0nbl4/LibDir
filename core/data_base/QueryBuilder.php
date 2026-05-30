<?php
namespace core\data_base;
use PDO;
use PDOException;

/**
 * Fluent query builder for constructing SQL queries with parameter binding
 * Supports SELECT, INSERT, UPDATE, DELETE operations with WHERE, JOIN, ORDER BY, etc.
 */
class QueryBuilder
{
    // Query configuration properties
    private string $table = '';
    private string $type = 'select';
    private array $where = [];
    private array $select = ['*'];
    private ?int $limit = null;
    private ?int $offset = null;
    private array $orderBy = [];
    private array $params = [];
    private array $data = [];
    private array $groupBy = [];
    private array $join = [];

    // SQL debugging properties
    private ?string $lastSql = null;
    private bool $sqlRequested = false;

    /**
     * Sets the table name for the query
     */
    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Specifies columns to select (defaults to *)
     */
    public function select(array $columns): self
    {
        $this->select = $columns;
        return $this;
    }

    /**
     * Adds a WHERE condition with AND logic
     */
    public function where(string $column, string $operator, $value): self
    {
        $paramName = 'param_' . count($this->params);
        if (strtoupper($operator) === 'IN' && is_array($value)) {
            $placeholders = [];
            foreach ($value as $i => $val) {
                $arrayParamName = $paramName . '_' . $i;
                $placeholders[] = ":$arrayParamName";
                $this->params[$arrayParamName] = $val;
            }
            $this->where[] = [
                "type" => "AND",
                "condition" => "$column IN (" . implode(', ', $placeholders) . ")"
            ];
        } else {
            $this->where[] = [
                "type" => "AND",
                "condition" => "$column $operator :$paramName"
            ];
            $this->params[$paramName] = $value;
        }
        return $this;
    }

    /**
     * Adds a WHERE condition with OR logic
     */
    public function orWhere(string $column, string $operator, $value): self
    {
        $paramName = 'param_' . count($this->params);
        if (strtoupper($operator) === 'IN' && is_array($value)) {
            $placeholders = [];
            foreach ($value as $i => $val) {
                $arrayParamName = $paramName . '_' . $i;
                $placeholders[] = ":$arrayParamName";
                $this->params[$arrayParamName] = $val;
            }
            $this->where[] = [
                "type" => "OR",
                "condition" => "$column IN (" . implode(', ', $placeholders) . ")"
            ];
        } else {
            $this->where[] = [
                "type" => "OR",
                "condition" => "$column $operator :$paramName"
            ];
            $this->params[$paramName] = $value;
        }
        return $this;
    }

    /**
     * Adds a JOIN clause to the query
     */
    public function join(string $table, string $first, string $operator, string $second, string $type = 'INNER'): self
    {
        $this->join[] = "$type JOIN $table ON $first $operator $second";
        return $this;
    }

    public function leftJoin(string $table, string $first, string $operator, string $second): self
    {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function groupBy(array $columns): self
    {
        $this->groupBy = array_merge($this->groupBy, $columns);
        return $this;
    }

    /**
     * Enables SQL debug mode
     * Следующий вызов get/first/insert/update/delete вернёт SQL-строку вместо выполнения
     */
    public function sql(): self
    {
        $this->sqlRequested = true;
        return $this;
    }

    /**
     * Returns the last generated SQL string (available after any execution method)
     */
    public function getLastSql(): ?string
    {
        return $this->lastSql;
    }

    // ================= EXECUTION METHODS =================

    public function get(): array|string
    {
        $this->type = 'select';
        $sql = $this->buildSelectQuery();

        if ($this->sqlRequested) {
            $this->sqlRequested = false;
            $this->lastSql = $this->interpolateQuery($sql);
            return $this->lastSql;
        }

        $stmt = DB::getPdo()->prepare($sql);
        foreach ($this->params as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("<b>Fatal query error:</b> $e");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first(): array|string|null
    {
        $this->limit(1);
        $results = $this->get();

        // Если был режим sql(), get() уже вернул строку
        if (is_string($results)) {
            return $results;
        }

        return $results[0] ?? null;
    }

    public function insert(array $data): bool|string
    {
        $this->type = 'insert';
        $this->data = $data;
        $sql = $this->buildInsertQuery();

        if ($this->sqlRequested) {
            $this->sqlRequested = false;
            $this->lastSql = $this->interpolateQuery($sql);
            return $this->lastSql;
        }

        $stmt = DB::getPdo()->prepare($sql);
        foreach ($this->data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            die("<b>Fatal query error:</b> $e");
        }
    }

    public function update(array $data = []): int|string
    {
        $this->type = 'update';
        if (!empty($data)) {
            $this->data = $data;
        }
        $sql = $this->buildUpdateQuery();

        if ($this->sqlRequested) {
            $this->sqlRequested = false;
            $this->lastSql = $this->interpolateQuery($sql);
            return $this->lastSql;
        }

        $stmt = DB::getPdo()->prepare($sql);
        foreach ($this->data as $key => $value) {
            $stmt->bindValue(":set_$key", $value);
        }
        foreach ($this->params as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("<b>Fatal query error:</b> $e");
        }
        return $stmt->rowCount();
    }

    public function delete(): int|string
    {
        $this->type = 'delete';
        $sql = $this->buildDeleteQuery();

        if ($this->sqlRequested) {
            $this->sqlRequested = false;
            $this->lastSql = $this->interpolateQuery($sql);
            return $this->lastSql;
        }

        $stmt = DB::getPdo()->prepare($sql);
        foreach ($this->params as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("<b>Fatal query error:</b> $e");
        }
        return $stmt->rowCount();
    }

    // ================= QUERY BUILDERS =================

    private function buildSelectQuery(): string
    {
        $sql = "SELECT " . implode(', ', $this->select) . " FROM " . $this->table;
        if (!empty($this->join)) $sql .= " " . implode(' ', $this->join);
        if (!empty($this->where)) $sql .= " WHERE " . $this->buildWhereClause();
        if (!empty($this->groupBy)) $sql .= " GROUP BY " . implode(', ', $this->groupBy);
        if (!empty($this->orderBy)) $sql .= " ORDER BY " . implode(', ', $this->orderBy);
        if ($this->limit !== null) $sql .= " LIMIT " . $this->limit;
        if ($this->offset !== null) $sql .= " OFFSET " . $this->offset;
        return $sql;
    }

    private function buildInsertQuery(): string
    {
        $columns = implode(', ', array_keys($this->data));
        $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($this->data)));
        return "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
    }

    private function buildUpdateQuery(): string
    {
        $setParts = [];
        foreach ($this->data as $column => $value) {
            $setParts[] = "$column = :set_$column";
        }
        $sql = "UPDATE {$this->table} SET " . implode(', ', $setParts);
        if (!empty($this->where)) $sql .= " WHERE " . $this->buildWhereClause();
        if ($this->limit !== null) $sql .= " LIMIT " . $this->limit;
        return $sql;
    }

    private function buildDeleteQuery(): string
    {
        $sql = "DELETE FROM {$this->table}";
        if (!empty($this->where)) $sql .= " WHERE " . $this->buildWhereClause();
        if ($this->limit !== null) $sql .= " LIMIT " . $this->limit;
        return $sql;
    }

    private function buildWhereClause(): string
    {
        $whereParts = [];
        $firstCondition = true;
        foreach ($this->where as $condition) {
            if ($firstCondition) {
                $whereParts[] = $condition['condition'];
                $firstCondition = false;
            } else {
                $whereParts[] = $condition['type'] . ' ' . $condition['condition'];
            }
        }
        return implode(' ', $whereParts);
    }

    // ================= DEBUG HELPERS =================

    private function interpolateQuery(string $query): string
    {
        $params = $this->getAllParams();
        if (empty($params)) return $query;

        $keys = [];
        $values = [];
        foreach ($params as $key => $value) {
            $searchKey = ':' . $key;
            if (strpos($query, $searchKey) !== false) {
                $keys[] = $searchKey;
                $values[] = $this->quoteValue($value);
            }
        }
        return str_replace($keys, $values, $query);
    }

    private function getAllParams(): array
    {
        $params = $this->params;
        if (in_array($this->type, ['update', 'insert']) && !empty($this->data)) {
            foreach ($this->data as $key => $value) {
                $paramKey = $this->type === 'update' ? 'set_' . $key : $key;
                $params[$paramKey] = $value;
            }
        }
        return $params;
    }

    private function quoteValue($value): string
    {
        if (is_string($value)) return "'" . addslashes($value) . "'";
        if (is_bool($value)) return $value ? '1' : '0';
        if (is_null($value)) return 'NULL';
        if (is_array($value)) return "(" . implode(', ', array_map([$this, 'quoteValue'], $value)) . ")";
        return (string)$value;
    }
}