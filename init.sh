#!/bin/bash

echo "Welcome to the package generator for Laravel 10.x"

# Ask for the package vendor
read -p "Enter the package vendor (default: SertxuDeveloper):" vendor

# Ask for the package name
read -p "Enter the package name (e.g. MyPackage):" package

# Ask for the package description
read -p "Enter the package description (e.g. My awesome package):" description

# Ask for the package tags
read -p "Enter the package tags (e.g. tag1,tag2,tag3):" tags

# Ask for the package license
read -p "Enter the package license (e.g. MIT):" license

function toSnakeCase {
    echo $1 | sed -r 's/([A-Z])/-\1/g' | tr '[:upper:]' '[:lower:]'
}

function toPascalCase {
    echo $1 | sed -r 's/(^|-)([a-z])/\U\2/g'
}

function listToArray {
    echo "array("$(echo $1 | sed -r 's/,/","/g')")"
}

package_vendor=$(toSnakeCase $vendor)
package_name=$(toSnakeCase $package)
package_keywords=$(listToArray $tags)
PackageVendor=$(toPascalCase $vendor)
PackageName=$(toPascalCase $package)
current_year=$(date +"%Y")

# Replace placeholders in composer.json
sed -i "s/{package_vendor}/$package_vendor/g" composer.json
sed -i "s/{package_name}/$package_name/g" composer.json
sed -i "s/{package_description}/$description/g" composer.json
sed -i "s/{package_keywords}/$package_keywords/g" composer.json
sed -i "s/{PackageVendor}/$PackageVendor/g" composer.json
sed -i "s/{PackageName}/$PackageName/g" composer.json

# Replace placeholders in README.md
sed -i "s/{package_vendor}/$package_vendor/g" README.md
sed -i "s/{package_name}/$package_name/g" README.md
sed -i "s/{PackageVendor}/$PackageVendor/g" README.md
sed -i "s/{PackageName}/$PackageName/g" README.md
sed -i "s/{current_year}/$current_year/g" README.md

# Replace placeholders in phpunit.xml.dist
sed -i "s/{PackageName}/$PackageName/g" phpunit.xml.dist

# Rename the Service Provider
ServiceProviderPath="src/${PackageName}ServiceProvider.php"
mv src/{PackageName}ServiceProvider.php $ServiceProviderPath

# Replace placeholders in src/{PackageName}ServiceProvider.php
sed -i "s/{PackageVendor}/$PackageVendor/g" $ServiceProviderPath
sed -i "s/{PackageName}/$PackageName/g" $ServiceProviderPath
sed -i "s/{package_name}/$package_name/g" $ServiceProviderPath

# Rename the config file
ConfigPath="config/${package_name}.php"
mv config/{package_name}.php $ConfigPath

# Replace placeholders in config/{package_name}.php
sed -i "s/{package_name}/$package_name/g" $ConfigPath

echo "Package generated successfully! Let's develop something awesome! 🚀✨"
