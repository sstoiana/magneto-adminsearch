# Magento Admin Configuration Search widget

This extensions allows quick access to configuration options in Magento's admin panel

## INSTALLATION 

### Via Modman
 - Modman required: <http://code.google.com/p/module-manager/>
 - Magento patch to allow symlinks for templates dir: <http://www.tonigrigoriu.com/magento/magento-how-to-fix-template-path-errors-when-using-symlinks/> (required if you choose to use modman installation) OR set "Allow Symlinks" under System / Configuration / Developer / Template Settings in Magento 1.5.0.0 or later
 - Install via modman (for details consult modman website):

        cd <magento root folder>
        modman init
        modman magneto-adminsearch clone https://github.com/sstoiana/magneto-adminsearch.git

 - Make sure you've cleaned Magento's cache to enable the new module

### Via Magento Connect
Magento Connect extension package is available here: http://www.magentocommerce.com/magento-connect/sstoiana/extension/6715/magnetoadminsearch 

## FEATURES 

 - Search configuration items and sections in Magento's Configuration admin page
 - Works with translated admin options (you can search for "Wochenende" in German instead of "Weekend Days" in English)



