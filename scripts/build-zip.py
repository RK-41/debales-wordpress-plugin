import subprocess
import zipfile
import sys
import os
from os import path

if __name__ == '__main__':
    # first run build-frontend.py
    build_frontend_path = path.join(path.dirname(__file__), 'build-frontend.py')
    subprocess.run(
        [sys.executable, build_frontend_path],
        check=True,
        cwd=path.dirname(build_frontend_path)
    )

    # then zip the plugin at ../debales-ai-assistant
    plugin_src_dir = path.join(path.dirname(__file__), '..', 'debales-ai-assistant')
    plugin_zip_path = path.join(path.dirname(__file__), '..', 'debales-ai-assistant.zip')

    with zipfile.ZipFile(plugin_zip_path, 'w') as plugin_zip:
        for root, dirs, files in os.walk(plugin_src_dir):
            for file in files:
                plugin_zip.write(path.join(root, file), path.relpath(path.join(root, file), path.join(plugin_src_dir, '..')))

    print(f'Plugin zip file written to {plugin_zip_path}')
