# Real Words
Simple algorithm to devine the legitimacy of a submitted email from a form

A customer was receiving a ton of emails with the typical garbage.

Initially I added a simple session to throttle the emails down. And that was effective at lowering the volume, but wasn't ideal.

I knew about real word algorithms but only found classes. I didn't see any simple solutions...so I wrote one.

## Version

### 2.0.2 - Jan 4, 2016

* Add feature to filter non-ascii characters in response to foreign emails

### 2.0.1 - Jan 3, 2016

* Moved everything into a proper class
* Added debugging
* Removed foreach loops
* Added loop through pharma words instead of checking string as a whole, which was a bug