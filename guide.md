# AlmaLinux 10 VM with Docker and Apache-PHP-MySQL Stack

This repository provides a `Vagrantfile` to quickly provision an AlmaLinux 10 virtual machine with Docker installed. It then leverages Docker Compose to deploy a robust Apache, PHP-FPM, and MySQL (APM) development stack. This setup is designed for efficient local development of PHP applications.

---

## Features

* **AlmaLinux 10 VM**: A stable and modern Linux distribution serving as the base for your development environment.

* **Docker Pre-installed**: Docker Engine and Docker CLI are automatically installed and configured within the VM during provisioning.

* **Persistent MySQL Database**: Your MySQL data is stored in a named Docker volume (`db_data`), ensuring data persistence even if containers are recreated or removed.

* **Configurable APM Stack**: Easily customize your PHP version, Apache configurations, and MySQL settings through dedicated Dockerfiles and configuration files.

* **Code Synchronization**: Your local project code (from the `src/` directory) is mounted into the PHP and Apache containers, enabling real-time development and testing.

* **Custom Hostname**: Access your application using a friendly hostname like `my-php-app.local` (configurable in `docker-compose.yml` for the `web` service).

---

## Prerequisites

Before you begin, ensure you have the following software installed on your host machine:

* **Vagrant**: [Download and Install Vagrant](https://developer.hashicorp.com/vagrant/install)

* **VirtualBox**: [Download and Install VirtualBox](https://www.virtualbox.org/wiki/Downloads)

---

## Getting Started

Follow these steps to set up and launch your development environment:

1.  **Get the files**:  
    Download and unpack the archive to a folder that you want to work in -> [Download Archive](https://github.com/user-attachments/files/20577117/vagrant.zip)

2.  **Initialize and Start the Alma Linux 10 VM**:

    Since you are on Windows, you can use the two .bat files for easier setup and control "Vagrant START" and "Vagrant STOP".
    
    Or manually navigate to the vagrant folder (where the `Vagrantfile` is located) and run:

    ```bash
    vagrant up
    ```

    This command will:
    * Download the `almalinux/10` Vagrant box.
    * Create and configure the VirtualBox VM with 4GB RAM and 2 CPUs.
    * Install Docker, Docker CLI, and Containerd within the VM.
    * Start and enable the Docker service.
    * Add the `vagrant` user to the `docker` group.
    * Navigate into the `/vagrant/Apache-PHP-MySQL` directory inside the VM.
    * Execute `docker compose up -d` to build and start your Apache, PHP-FPM, and MySQL containers in detached mode.

3.  **Access Your Application**:
    Once `vagrant up` completes successfully, your Apache-PHP-MySQL stack will be running inside the VM.

    * **Web Server (Apache)**:
        Your web application will be accessible on the IP of the VM. You can access it via:
        
        * **VM's Public IP**: You can find the VM's public IP address by running `vagrant ssh` to connect to the Linux VM,  
        and then `hostname -I` inside the linux VM to see the public IP it has.

    * **Database (MySQL)**:
        The MySQL database is exposed on port `3306` on the VM's public network interface. You can connect from your host machine using a database client (e.g., DBeaver, MySQL Workbench) with the following credentials (as defined in `docker-compose.yml`):
        * **Host**: The public IP address of your Vagrant VM.
        * **Port**: `3306`
        * **User**: `my_user`
        * **Password**: `my_password`
        * **Database**: `my_database`

---

## Project Structure

The expected directory structure for this setup is as follows:

```
vagrant
├── Vagrantfile                       # Defines the Vagrant VM and its provisioning
└── Apache-PHP-MySQL/                 # This directory is synced to /vagrant/Apache-PHP-MySQL in the VM
    ├── docker-compose.yml            # Defines the Docker services (Apache, PHP-FPM, MySQL)
    ├── src/                          # Your PHP application code goes here (mounted into containers)
    │   └── index.php                 # Example: A simple PHP entry file
    └── docker/                       # Docker-related configurations and Dockerfiles
        ├── apache/
        │   ├── httpd.conf            # Custom Apache main configuration
        │   └── vhosts.conf           # Apache virtual hosts configuration
        ├── db/
        │   └── init/                 # Optional: Place .sql files here for database initialization
        └── php/
            ├── Dockerfile            # Custom Dockerfile for the PHP-FPM service
            └── php.ini               # Custom PHP runtime configuration
```

---

## Customization

You can easily tailor this development environment to your specific needs:

* **Vagrant VM Resources**:
    Modify the `Vagrantfile` to adjust `vb.memory` (e.g., `"8192"` for 8GB), `vb.cpus` (e.g., `4`), or change the `config.vm.box` to a different AlmaLinux version or another OS.
* **Docker Compose Services**:
    Edit `docker-compose.yml` to:
    * Change service names, exposed ports, or environment variables.
    * Add more services (e.g., Redis, Node.js).
    * Adjust image versions (e.g., `mysql:8.0` to `mysql:latest`).
* **MySQL Credentials**:
    Update the `MYSQL_ROOT_PASSWORD`, `MYSQL_DATABASE`, `MYSQL_USER`, and `MYSQL_PASSWORD` environment variables under the `db` service in `docker-compose.yml`.
* **PHP Version and Extensions**:
    Modify `docker/php/Dockerfile` to change the base PHP-FPM image version or to install additional PHP extensions.
* **Apache Configuration**:
    Adjust `docker/apache/httpd.conf` and `docker/apache/vhosts.conf` to configure Apache's main settings and virtual hosts.
* **PHP Configuration**:
    Customize `docker/php/php.ini` for PHP runtime settings like `memory_limit`, `upload_max_filesize`, or `xdebug` settings.
* **Project Code**:
    Place all your PHP application files within the `src/` directory. These files are automatically synchronized with `/var/www/html` inside the `php` and `web` containers.

---

## Useful Vagrant Commands

These commands are executed from your host machine in the directory containing the `Vagrantfile`:

* `vagrant up`: Starts and provisions the VM.
* `vagrant halt`: Gracefully shuts down the VM.
* `vagrant suspend`: Suspends the VM, saving its current state to disk.
* `vagrant resume`: Resumes a suspended VM.
* `vagrant reload`: Restarts the VM and re-applies any changes made to the `Vagrantfile`.
* `vagrant ssh`: Connects to the VM via SSH.
* `vagrant destroy`: Stops and deletes all traces of the VM from your system. **Use with caution!**

---

## Troubleshooting

* **Port Conflicts**: If `vagrant up` fails due to ports `80` or `3306` already being in use on your host machine, you can modify the host port mappings in `docker-compose.yml` (e.g., `8080:80` for Apache, `3307:3306` for MySQL).
* **Vagrant Box Download Issues**: If `vagrant up` struggles to download the AlmaLinux box, check your internet connection. You can also try downloading the box manually and adding it to Vagrant.
* **Docker Compose Service Errors**: If the Docker Compose services don't start as expected, SSH into the VM (`vagrant ssh`) and use Docker commands to inspect:
    * `docker ps -a`: List all containers (running and stopped).
    * `docker logs <container_name>`: View logs for a specific container (e.g., `docker logs apache-web`).
    * `docker compose ps`: Check the status of your Docker Compose services.

---