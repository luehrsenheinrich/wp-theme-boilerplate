workflow "Release to update server" {
  on = "release"
  resolves = ["luehrsenheinrich/action-release-assets-ftp@master"]
}

action "luehrsenheinrich/action-release-assets-ftp@master" {
  uses = "luehrsenheinrich/action-release-assets-ftp@master"
  secrets = ["GITHUB_TOKEN", "FTP_PASSWORD", "FTP_USERNAME"]
  env = {
    FTP_SERVER = "ftp.luehrsenheinrich.de"
  }
}
