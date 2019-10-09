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

**Assumptions**  

### Fees calculator ###  

The minimum amount for a loan is £1,000, and the maximum is £20,000.
Values will always be within this range but they may be any value
up to 2 decimal places.
The term can be either 12 or 24 (number of months).

Sample loan and interests values are shown on matrix below.
Code interpolates values between the breakpoints linearly between
the lower bound and upper bound that they fall between. The fee is
"rounded up" such that (fee + loan amount) is an exact multiple of 5.

### Term 12
```
£1000: £50 5%
£2000: £90 4,5%
£3000: £90 3%
£4000: £115 2,8%
£5000: £100 2%
£6000: £120 2%
£7000: £140 2%
£8000: £160 2%
£9000: £180 2%
£10000: £200 2%
£11000: £220 2%
£12000: £240 2%
£13000: £260 2%
£14000: £280 2%
£15000: £300 2%
£16000: £320 2%
£17000: £340 2%
£18000: £360 2%
£19000: £380 2%
£20000: £400 2%
```

### Term 24

```
£1000: £70  7%
£2000: £100 5%
£3000: £120 4%
£4000: £160 4%
£5000: £200 4%
£6000: £240 4%
£7000: £280 4%
£8000: £320 4%
£9000: £360 4%
£10000: £400 4%
£11000: £440 4%
£12000: £480 4%
£13000: £520 4%
£14000: £560 4%
£15000: £600 4%
£16000: £640 4%
£17000: £680 4%
£18000: £720 4%
£19000: £760 4%
£20000: £800 4%
```
