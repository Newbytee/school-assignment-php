echo "----- starta scriptet -----" >> setup.log
echo "" >> setup.log

echo "----- lägg till repot för att ta hem php7 -----" >> setup.log
sudo add-apt-repository ppa:ondrej/php -y
echo "" >> setup.log

echo "----- uppdatera paketinfo -----" >> setup.log
sudo apt-get update -y
echo "" >> setup.log

echo "----- installera moduler för php7 -----" >> setup.log
sudo apt-get install php7.0-curl php7.0-cli php7.0-dev php7.0-gd php7.0-intl php7.0-mcrypt php7.0-json php7.0-mysql php7.0-opcache php7.0-bcmath php7.0-mbstring php7.0-soap php7.0-xml php7.0-zip php7.0-sqlite -y
echo "" >> setup.log

echo "----- installera php7 -----" >> setup.log
sudo apt-get install libapache2-mod-php7.0 -y
echo "" >> setup.log

echo "----- disable php5 -----" >> setup.log
sudo a2dismod php5 >> setup.log
echo "" >> setup.log

echo "----- enable php7 -----" >> setup.log
sudo a2enmod php7.0 >> setup.log
echo "" >> setup.log

echo "----- startar om apache2 -----" >> setup.log
service apache2 restart >> setup.log
echo "" >> setup.log

echo "----- Kontrollera versionsnummer på php -----" >> setup.log
php -v >> setup.log
echo "" >> setup.log

echo "----- Ta in kint -----" >> setup.log
composer require kint-php/kint