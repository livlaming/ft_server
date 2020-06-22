# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR ./root

# # Copy the file from your host to your current location.
COPY srcs .

# # Run the command inside your image filesystem.
RUN \ 
apt-get update -y && \
apt-get -y upgrade && \
apt-get install -y nginx && \
apt-get install -y wordpress
#apt-get install -y mariadb


RUN nginx
#sed -e 's/# \.*multiverse$\)/\1\g' /etc/apt/sources.list 
#apt-get install -y nginx && \
#apt-get install -y nginx && \



# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80

# # Run the specified command within the container.
#CMD ["echo", "hello world"]

# # Copy the rest of your app's source code from your host to your image filesystem.
#COPY script.sh /script.sh

#CMD ["/script.sh"]
#CMD [bash]