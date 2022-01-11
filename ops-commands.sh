ops-codecept() {
    cmd-doc "Run codeception tests."
    ops shell vendor/bin/codecept "$@"
}