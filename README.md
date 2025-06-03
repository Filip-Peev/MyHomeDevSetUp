# Virtualization Inception Setup

This setup involves a multi-layered virtualization environment, running multiple virtual machines (VMs) inside each other, with Docker containers powering a homedev environment with Apache, PHP, and MySQL.

## System Overview

1. **Host System**: 
   - **Windows 11** running **VMware Workstation**.
   
2. **Virtual Machine**: 
   - A **Windows 10 VM** running inside VMware Workstation.

3. **Nested Virtualization**: 
   - Inside the **Windows 10 VM**, **VirtualBox** is running to host **AlmaLinux 10**.

4. **Containers**: 
   - Inside **AlmaLinux 10**, **Docker** is running **three containers** to power the homedev environment:
     - **Apache** for web server functionality
     - **PHP** for server-side scripting
     - **MySQL** for database management

## Architecture

- **VMware Workstation (Windows 11 Host)** → **Windows 10 VM** → **VirtualBox** → **AlmaLinux 10** → **Docker Containers (Apache, PHP, MySQL)**

It’s virtualization Inception — a VM inside a VM inside a VM, all the way down! 😄

## Use Case

This setup is useful for creating isolated environments for homedev, testing, or experimenting with multiple layers of virtualization. It demonstrates how complex virtualized environments can be stacked, though performance may be impacted due to the nested nature of the system. The Apache, PHP, and MySQL containers make it a convenient, fully integrated LAMP stack for development.

## Requirements

- **VMware Workstation** (Windows 11 Host)
- **VirtualBox** (inside Windows 10 VM)
- **Docker** (inside AlmaLinux 10)
- **Apache**, **PHP**, **MySQL** Docker containers for web and database development.

## Notes

This architecture is not meant for production but rather for testing and experimentation. Performance might be significantly affected due to the nested virtualization layers!  
If you want to replicate this setup, open [guide.md](https://github.com/Filip-Peev/MyHomeDevSetUp/blob/main/guide.md) and follow the instructions there. We won't use VMware, only VirtualBox.