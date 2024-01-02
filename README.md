# Debales AI Assistant - WordPress Plugin

This repository contains the WordPress plugin for Debales AI Assistant.

## Development

Inside `docker-setup` directory, there are essential files to setup a local development environment for this plugin. The setup includes a WordPress installation and a MySQL database. Also, the directory `docker-setup/wordpress-content` is mounted as the `/var/www/html` of the WordPress container. So, any changes made to the files inside `docker-setup/wordpress-content` will be reflected in the WordPress installation.

After installing and add the `bot-it` in the settings. See the video for demonstration.

https://github.com/Brainlox-AI/debales-wordpress-plugin/assets/49693820/eeb02a28-1266-4f10-b516-26125095b689


### Setup

1. Install [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/install/).
2. Clone this repository.
3. Run `docker-compose up -d` inside `docker-setup` directory.
4. Visit `http://localhost:80` to access the WordPress installation.

### WordPress Initialization

After the initial setup, you need to initialize the WordPress installation. Just visiting `http://localhost:80` and following the on-screen instructions will do the job.

### Plugin Installation (hot reload)

There's a script called `scripts/dev-reload.py` which can be used to install the plugin in the WordPress installation. This script will also watch for any changes made to the plugin files and will automatically reload the plugin in the WordPress installation.

To use this script, you need to have Python 3 installed in your system. Also, you would have to install the dependencies using `pip install -r scripts/requirements.txt`.

I would recommend creating a virtual environment.

```sh
python3 -m venv scripts/.venv
source scripts/.venv/bin/activate
pip install -r scripts/requirements.txt
```

After that, you can run the script using `python scripts/dev-reload.py` in the same terminal session.

After that you would need to activate the plugin, see https://wordpress.org/documentation/article/manage-plugins/#manual-plugin-installation-1.

### Frontend Development

The frontend of this plugin is built using [Vite.js](https://vitejs.dev). It uses the npm package [@debales-ai/ai-assistant](https://www.npmjs.com/package/@debales-ai/ai-assistant) for the FAB button.

To start the development server, run `npm run dev` inside `frontend` directory. This will start a development server at `http://localhost:3000`. Any changes made to the files inside `frontend/src` will be reflected in the development server.

The frontend will automatically be built when the plugin is deployed. Though, if you want to test it locally first, run `python3 scripts/build-frontend.py`.

## Deployment (Building the Zip File)

To deploy the plugin, run `python3 scripts/build-zip.py`. This will create a zip file called `debales-ai-assistant.zip`. You can upload this zip file to your WordPress installation to install the plugin or give it to someone else to install it.

See https://wordpress.org/documentation/article/manage-plugins/#manual-plugin-installation-1 for more information on how to install a plugin manually.

> [!NOTE]\
> The script would automatically build the frontend before creating the zip file.
