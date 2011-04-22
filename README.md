# Magento Admin Configuration Search widget

## INSTALLATION 

### Via Modman
 - Modman required: <http://code.google.com/p/module-manager/>
 - Magento patch to allow symlinks for templates dir: <http://www.tonigrigoriu.com/magento/magento-how-to-fix-template-path-errors-when-using-symlinks/> (required if you choose to use modman installation)
 - Install via modman (for details consult modman website):

        cd <magento root folder>
        modman init
        modman magneto-adminsearch clone https://github.com/sstoiana/magneto-adminsearch.git

 - Make sure you've cleaned Magento's cache to enable the new module

### Via Magento Connect
Soon we'll make available a Magento extension package that can be installed via Admin.

## FEATURES 

 - Search configuration items and sections in Magento's Configuration admin page



