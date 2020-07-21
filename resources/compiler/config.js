module.exports = {
  context: "resources/assets",
  entry: {
    styles: "./styles/main.scss",
    scripts: "./scripts/main.js"
  },
  devtool: "cheap-module-eval-source-map",
  outputFolder: "assets",
  publicFolder: "assets",
  proxyTarget: "http://multisitecalsglobal.local/",
  watch: ["../**/*.php"]
};
