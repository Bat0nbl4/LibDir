<footer class="bg-dark p-3 mt-5">
    <a class="btn btn-outline-secondary mb-1" data-bs-toggle="collapse" href="#session_data" role="button" aria-expanded="false" aria-controls="collapseExample">session data (dev mode debug)</a>
    <pre class="collapse text-white " id="session_data">
        <?php print_r(\core\session\Session::all()); ?>
    </pre>
</footer>