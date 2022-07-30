# Description
MyWarn is a simple moderation plugin, which allows you to warn a player.


# Commands
MyWarn has 2 simple user commands such as:

/warn (user): This one will open you a ui to give a user’s warning reason.

/Warnlist (user): With this command, you could simply see the number to warn a user as well as all that is warning


# Configuration
The configuration system is very easy to use, modify all messages as you wish.
```YAML
version: 1.0.0
prefix: §6MyWarn §7>§r
messages:
  warn:
    playerNotExists: '{prefix} §cThe player does not exist on the server.'
    adminMessage: '{prefix} You warned §e{user}§r for the reason §e{reason}§r.'
    playerMessage: '{prefix} You were warned by a staff member for the reason §e{reason}§r.'
  warnlist:
    noWarn: '{prefix} §cThe user has no warning.'
    warn: '{prefix} §e{user}§r has §e{number}§r warnings:'
```
