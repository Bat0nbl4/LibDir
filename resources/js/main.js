function resouce(path) {
    if (config["USE_BASE_PATH"]) {
        return config["BASE_PATH"] + config["RESOURCE_PATH"] + path;
    } else {
        return config["RESOURCE_PATH"] + path;
    }
}