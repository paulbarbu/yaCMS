#!/bin/sh
#

# {{{ Environment settings
errorlog="${HOME}/.xerrors"
# }}}


# {{{ Log settings
#
# Always start X11 with a clean log file
if (cp /dev/null "${errorlog}"); then
  chmod 600 "${errorlog}"
  exec >"${errorlog}" 2>&1
  break
fi
# }}}

# {{{ Resource and keymap settings
usermodmap="${HOME}/.Xmodmap"
userresources="${HOME}/.Xresources"
sysmodmap="/etc/X11/xinit/.Xmodmap"
sysresources="/etc/X11/xinit/.Xresources"

# Merge system and user resources and keymaps
[[ -r "${sysresources}" ]]  && xrdb -merge "${sysresources}"
[[ -r "${sysmodmap}" ]]     && xmodmap "${sysmodmap}"
[[ -r "${userresources}" ]] && xrdb -merge "${userresources}"
[[ -r "${usermodmap}" ]]    && xmodmap "${usermodmap}"
# }}}

# Xwrits reminds you to take wrist breaks and avoid RSI
#xwrits typetime=45 clock breakclock top ready-picture="${HOME}/.xwrits/ready.gif" \
 # rest-picture="${HOME}/.xwrits/rest.gif" warning-picture="${HOME}/.xwrits/warning.gif" &

#autostart
xset b off
archassistant &
xfce4-clipman &
yapan &
#xwrits typetime=45 breakclock top after 15 clock multiply=5:1.4 &
gnote &

case $1 in
awesome)
	exec ck-launch-session awesome
	;;
gnome)
	exec ck-launch-session gnome-session
	;;
*)
	exec ck-launch-session awesome
	;;
esac
#exec ck-launch-session gnome-session
