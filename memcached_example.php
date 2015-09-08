<?php
$cache = new Memcached();
$cache->addServer("localhost", 11211);
$cache->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

// Add first entry to cache
if ($cache->add("firstKey", "First")) {
    echo("Value for 'firstKey': " . $cache->get("firstKey") . "\n");
}

// Change value
if ($cache->set("firstKey", "First Updated")){
    echo("New value for 'firstKey': " . $cache->get("firstKey") . "\n");
}

// Add second entry to cache
if ($cache->add("secondKey", "Second")){
	echo("Value for 'secondKey': " . $cache->get("secondKey") . "\n");
}

// Try to get something that doesn't exist
if ($cache->get("thirdKey")){
	echo("Value for 'thirdKey': " . $cache->get("thirdKey") . "\n");
} else {
	echo("'thirdKey' doesn't exist \n");
}

// Get both entries at same time
$map = $cache->getMulti(array("firstKey", "secondKey"));
if ($map) {
    echo("Value for 'firstKey': " . $map["firstKey"] . ", and value for 'secondKey': " . $map["secondKey"] . "\n");
}

// Remove a single entry
if ($cache->delete("firstKey")){
    echo("Removed first entry from cache.\n");
}

// Remove all entries
if ($cache->flush()){
    echo("Cleared entire cache.\n");
}