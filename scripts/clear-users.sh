rm -rf  ../users/*

echo "tony:rogers" > ../users/.htpasswd

mkdir -p ../users/tony/messages/
touch ../users/tony/feed
