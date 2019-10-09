**Set up app:**  
1. Clone  
2. Execute `composer install`  


**Run with command:**  
1. From command line execute `php application.php app:calculate`. You will be prompted for term and amount.  

**Run Unit Tests:**  
1. From command line execute: `./vendor/bin/phpunit tests/FeeCalculatorManagerTest`  

**Run basic static code analysis:**  
1. Run: ` vendor/bin/phpstan analyse src tests`
2. Run: `vendor/bin/phpstan analyse -l 4 src tests`  
3. Run: `./vendor/bin/phpcbf -vvv src`

**App components (libraries):**  
1. Symfony DI   
2. Symfony Console  
3. UnitTests  
4. PHPStan (static code analysis tool)  
5. PHP_CodeSniffer  
