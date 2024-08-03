import subprocess
import shutil
import json
from os import path

FRONTEND_DIR = path.join(path.dirname(__file__), '..', "frontend")
PLUGIN_SRC_DIR = path.join(path.dirname(__file__), '..', "debales-ai-assistant")

if __name__ == "__main__":
    # call `npm run build` to build the frontend
    
    subprocess.run(
        ["npm", "run", "build"],
        cwd=FRONTEND_DIR,
        check=True,
        shell=False,
    )

    # read ./frontend/dist/.vite/manifest.json
    with open(path.join(FRONTEND_DIR, "dist/.vite/manifest.json")) as f:
        manifest = json.load(f)

    shutil.copy(
        path.join(FRONTEND_DIR, "dist/", manifest["index.html"]["file"]),
        path.join(PLUGIN_SRC_DIR, "debales-ai-assistant.min.js")
    )
