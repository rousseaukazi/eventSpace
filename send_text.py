import urllib2
import urllib

numbers = {
			'Rousseau'  : "6508420492", 
			'Channing'  : "8042294822",
			'Suman'     : "8477226071", 
			'Ashley M.' : "4086246110",
			'Ashley B.' : "9518928892",
			'Alexa'     : "6505213837", 
			'Jonathon'  : "8472716925",
			'Jelani'    : "9519929201",
			'Sumaya'    : "4157866212",
			'Joshua'    : "2532283438",
			'Rob'       : "9413024516",
			'Evan'      : "7143920591",
			'Maddie'    : "9145847487",
			'Addison'   : "3046155153",
			'Chris'     : "5514047775",
			'Vihang'    : "4014411418"
			}

theMessage1 = 'Hey Everyone! Welcome to day 3 of testing Event Space! Here is the link to the page that will host our shared album http://www.rousseaukazi.com/testing3.php'
theMessage2 = 'Remember you have to reply with the word "picture" and a photo to upload to the album.'



	
for num in numbers:
	#theMessage = "Hey " + num + "! Welcome to day 3 of Event Space testing. Here is the link to the page that will host our shared album http://www.rousseaukazi.com/testing3.php "
	#theMessage = "Hey " + num + "! Welcome to day 3 of Event Space testing. Today's focus is actions, starting with... Action #1: Take a photo of how you look right now! (Remember - reply with PICTURE and a photo) Today's shared album = http://www.rousseaukazi.com/testing3.php"
	theMessage = "Hey " + num + "! Welcome to Event Space testing day 3. Today's focus is actions, starting with... Action #1: How you look right now! (Remember - reply PICTURE + photo) Today's album = http://www.rousseaukazi.com/testing3.php"
	theMessage2 = "Hey " + num + "! Due to feature requests, we are not going to be testing extensively today. I know how sad you must be after hearing this news, so reply with the word SADFACE and a photo of your best sad face."   
	theMessage1 = 'Action Text 2: ' + num + ', take a picture of the nearest edible item! GO GO GO!'
	parameters = { 'client_id' : '1316', 'token' : 'dbd7557a6a9d09ab13fda4b5337bc9c7', 'campaign_id' : '28394', 'to' : numbers[num], 'message' : theMessage2, "format" : 'json'}
	url_encoded_parameters = urllib.urlencode(parameters)
	api_call = "https://api.mogreet.com/moms/transaction.send?" + url_encoded_parameters
	response_object = urllib2.urlopen(api_call)
	print response_object.read()

