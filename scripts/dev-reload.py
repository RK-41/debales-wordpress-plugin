import sys
import time
import logging
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
from pathlib import Path

SRC_PATH = Path(__file__).parent.parent / "debales-ai-assistant"
WORDPRESS_PATH = (
    Path(__file__).parent.parent
    / "docker-setup/wordpress-content/wp-content/plugins/debales-ai-assistant"
)

if __name__ == "__main__":
    # whenever a file in the plugin directory is changed
    # copy the changes to the wordpress plugin directory

    class PluginChangeHandler(FileSystemEventHandler):
        def on_any_event(self, event):
            if event.is_directory:
                return None

            if event.event_type == "created":
                # Take any action here when a file is first created.
                print("Received created event - %s." % event.src_path)
            elif event.event_type == "modified":
                # Taken any action here when a file is modified.
                print("Received modified event - %s." % event.src_path)
                # copy the file to the wordpress plugin directory
                src = Path(event.src_path)
                dst = WORDPRESS_PATH / src.name
                dst.write_text(src.read_text())
            elif event.event_type == "deleted":
                # Taken any action here when a file is modified.
                print("Received deleted event - %s." % event.src_path)
                # delete the file from the wordpress plugin directory
                dst = WORDPRESS_PATH / src.name
                dst.unlink()

    # create an observer for the plugin directory
    observer = Observer()
    observer.schedule(PluginChangeHandler(), str(SRC_PATH), recursive=True)
    observer.start()
    try:
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
        observer.stop()
    observer.join()
