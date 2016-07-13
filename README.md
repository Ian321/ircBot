# ircBot

This is a simple IRC-Bot made using PHP.  
Every command is a single .php file inside the commands folder.  

The configuration is very simple:  
(this example is for the twitch IRC)

| Variable  | Value         | What it does                                      |
|-----------|:-------------:|---------------------------------------------------|
| $server   | irc.twitch.tv | The sever the bot will connect to.                |
| $host     | tmi.twitch.tv | The server will tell you who it is.               |
| $port     | 6667          | The port the bot will use.                        |
| $admin    | USERNAME      | The name of the admin (you).                      |
| $triggerD | !             | The default command trigger.                      |
| $triggerE | 'ping' => '*',| If you want to use a different trigger for a command.|
| $channel  | #CHANNEL      | The channel on the server.                        |
| $name     | BOT-NAME      | The name of the bot.                              |
| $nick     | BOT-NICK      | The nick of the bot.                              |
| $pass     | oauth:xxxx... | The password/[outh-tocken](http://twitchapps.com/tmi/) of the bot.|

### *Useful variables and functions*

| Variable   | Value                            | Twitch only? |
|------------|----------------------------------|:------------:|
| $C_User    | The user who send the message.   |       No     |
| $C_Message | The message.                     |       No     |
| $varsIN    | Array of every word.             |       No     |
| $coms      | Array of all command.            |       No     |
| $pathIs    | Position of the main.php file.   |       No     |
| $isMod     | If the bot is mod in the channel.|       Yes    |
| $mods      | Array of mods (from the bot).    |       No     |

| Function               | What it does | Twitch only? |
|------------------------|--------------|:------------:|
| checkC ($who, $command)| $who can be: none, admin, mods or all.<br>  $command it what the function should look for.<br> e.g: checkC("mod", "xyz") will return **true** if a mod or admin writes "!xyz".| No |
| secondsToTimeString ($sec) | Will return a string like this one:<br> secondsToTimeString (7246) -> "2 hours and 46 seconds"| No |
| checkIfMod ($channel, $nick) | Will return **true** if the $nick is mod in the $channel. | Yes |
| checkCurrentGame ($channel)  | Will return the current game of $channel. | Yes |
| updateList () | Will update all list e.g: $mods, $isMod ... | No |
