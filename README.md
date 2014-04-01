# DHCP Monitor

Este projeto tem como intuito o monitoramento do serviço DHCP de uma máquina Debian 7.x Sever, para isto ele utiliza LAMP e DHCP com seguintes instrunções:

## Features

## Installation

```
# apt-get install isc-dhcp-server
```

```  
# /etc/network/interface
...
iface eth0 inet static
address 10.0.0.1
netmask 255.255.255.0
...
```

```
# /etc/dchp/dhcpd.conf
...

subnet 10.0.0.0 netmask 255.255.255.0 {
  range 10.0.0.10 10.0.0.254;
  option routers 10.0.0.1;
}

...
```


```  
# /etc/default/isc-dhcp-server
...

INTERFACES="eth0"

...
```

```
# /etc/init.d/isc-dhcp-server start
```

## Support

## License

Copyright (c) 2014 João Henrique

Licensed under the MIT.

