const fs = require("fs-extra");

const copyFiles = async () => {
  try {
    await fs.copy(
      "./node_modules/@pdftron/webviewer/public",
      "./public/webviewer/"
    );
    console.log("Les fichiers ont été copiés avec succes");
  } catch (err) {
    console.error(err);
  }
};

copyFiles();
