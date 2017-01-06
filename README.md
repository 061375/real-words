# Real Words
Simple algorithm to devine the legitimacy of a submitted email from a form

A customer was receiving a ton of emails with the typical garbage.

Initially I added a simple session to throttle the emails down. And that was effective at lowering the volume, but wasn't ideal.

I knew about real word algorithms but only found classes. I didn't see any simple solutions...so I wrote one.

The emails contain URLs. I can imagine that they are pingin back to a server.

These are probes and so despite not returning an error on my forms, in some cases, after a few days the emails have been modified to adapt.

In one case I have forced the attacker to post simple english text. With this version they won't have URLs


## Version

### 2.0.3 - Jan 6, 2017

* Added filter for http(s) URL(s)
* Added feature to filter HTML
* Added inline debug dump feature
* Non alpha-numeric test encompesses non ascii characters for redundency

### 2.0.2 - Jan 4, 2017

* Add feature to filter non-ascii characters in response to foreign emails

### 2.0.1 - Jan 3, 2017

* Moved everything into a proper class
* Added debugging
* Removed foreach loops
* Added loop through pharma words instead of checking string as a whole, which was a bug