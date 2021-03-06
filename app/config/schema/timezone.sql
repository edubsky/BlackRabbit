CREATE TABLE `timezones` (
`id` CHAR( 36 ) NOT NULL ,
`name` VARCHAR( 64 ) NOT NULL COMMENT 'Country/City mostly, as defined in php doc',
PRIMARY KEY ( `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `timezones` (`id`,`name`)
VALUES
(UUID(),'Africa/Abidjan'),
(UUID(),'Africa/Accra'),
(UUID(),'America/Atka'),
(UUID(),'America/Bahia'),
(UUID(),'America/Bahia_Banderas'),
(UUID(),'America/Barbados'),
(UUID(),'America/Belem'),
(UUID(),'America/Belize'),
(UUID(),'America/Blanc-Sablon'),
(UUID(),'America/Boa_Vista'),
(UUID(),'America/Bogota'),
(UUID(),'America/Boise'),
(UUID(),'America/Buenos_Aires'),
(UUID(),'America/Cambridge_Bay'),
(UUID(),'America/Campo_Grande'),
(UUID(),'America/Cancun'),
(UUID(),'America/Caracas'),
(UUID(),'America/Catamarca'),
(UUID(),'America/Cayenne'),
(UUID(),'America/Cayman'),
(UUID(),'America/Chicago'),
(UUID(),'America/Chihuahua'),
(UUID(),'America/Coral_Harbour'),
(UUID(),'America/Cordoba'),
(UUID(),'America/Costa_Rica'),
(UUID(),'America/Cuiaba'),
(UUID(),'America/Curacao'),
(UUID(),'America/Danmarkshavn'),
(UUID(),'America/Dawson'),
(UUID(),'America/Dawson_Creek'),
(UUID(),'America/Denver'),
(UUID(),'America/Detroit'),
(UUID(),'America/Dominica'),
(UUID(),'America/Edmonton'),
(UUID(),'America/Eirunepe'),
(UUID(),'America/El_Salvador'),
(UUID(),'America/Ensenada'),
(UUID(),'America/Fort_Wayne'),
(UUID(),'America/Fortaleza'),
(UUID(),'America/Glace_Bay'),
(UUID(),'America/Godthab'),
(UUID(),'America/Goose_Bay'),
(UUID(),'America/Grand_Turk'),
(UUID(),'America/Grenada'),
(UUID(),'America/Guadeloupe'),
(UUID(),'America/Guatemala'),
(UUID(),'America/Guayaquil'),
(UUID(),'America/Guyana'),
(UUID(),'America/Halifax'),
(UUID(),'America/Havana'),
(UUID(),'America/Hermosillo'),
(UUID(),'America/Indiana/Indianapolis'),
(UUID(),'America/Indiana/Knox'),
(UUID(),'America/Indiana/Marengo'),
(UUID(),'America/Indiana/Petersburg'),
(UUID(),'America/Indiana/Tell_City'),
(UUID(),'America/Indiana/Vevay'),
(UUID(),'America/Indiana/Vincennes'),
(UUID(),'America/Indiana/Winamac'),
(UUID(),'America/Indianapolis'),
(UUID(),'America/Inuvik'),
(UUID(),'America/Iqaluit'),
(UUID(),'America/Jamaica'),
(UUID(),'America/Jujuy'),
(UUID(),'America/Juneau'),
(UUID(),'America/Kentucky/Louisville'),
(UUID(),'America/Kentucky/Monticello'),
(UUID(),'America/Knox_IN'),
(UUID(),'America/La_Paz'),
(UUID(),'America/Lima'),
(UUID(),'America/Los_Angeles'),
(UUID(),'America/Louisville'),
(UUID(),'America/Maceio'),
(UUID(),'America/Managua'),
(UUID(),'America/Manaus'),
(UUID(),'America/Marigot'),
(UUID(),'America/Martinique'),
(UUID(),'America/Matamoros'),
(UUID(),'America/Mazatlan'),
(UUID(),'America/Mendoza'),
(UUID(),'America/Menominee'),
(UUID(),'America/Merida'),
(UUID(),'America/Metlakatla'),
(UUID(),'America/Mexico_City'),
(UUID(),'America/Miquelon'),
(UUID(),'America/Moncton'),
(UUID(),'America/Monterrey'),
(UUID(),'America/Montevideo'),
(UUID(),'America/Montreal'),
(UUID(),'America/Montserrat'),
(UUID(),'America/Nassau'),
(UUID(),'America/New_York'),
(UUID(),'America/Nipigon'),
(UUID(),'America/Nome'),
(UUID(),'America/Noronha'),
(UUID(),'America/North_Dakota/Beulah'),
(UUID(),'America/North_Dakota/Center'),
(UUID(),'America/North_Dakota/New_Salem'),
(UUID(),'America/Ojinaga'),
(UUID(),'America/Panama'),
(UUID(),'America/Pangnirtung'),
(UUID(),'America/Paramaribo'),
(UUID(),'America/Phoenix'),
(UUID(),'America/Port-au-Prince'),
(UUID(),'America/Port_of_Spain'),
(UUID(),'America/Porto_Acre'),
(UUID(),'America/Porto_Velho'),
(UUID(),'America/Puerto_Rico'),
(UUID(),'America/Rainy_River'),
(UUID(),'America/Rankin_Inlet'),
(UUID(),'America/Recife'),
(UUID(),'America/Regina'),
(UUID(),'America/Resolute'),
(UUID(),'America/Rio_Branco'),
(UUID(),'America/Rosario'),
(UUID(),'America/Santa_Isabel'),
(UUID(),'America/Santarem'),
(UUID(),'America/Santiago'),
(UUID(),'America/Santo_Domingo'),
(UUID(),'America/Sao_Paulo'),
(UUID(),'America/Scoresbysund'),
(UUID(),'America/Shiprock'),
(UUID(),'America/Sitka'),
(UUID(),'America/St_Barthelemy'),
(UUID(),'America/St_Johns'),
(UUID(),'America/St_Kitts'),
(UUID(),'America/St_Lucia'),
(UUID(),'America/St_Thomas'),
(UUID(),'America/St_Vincent'),
(UUID(),'America/Swift_Current'),
(UUID(),'America/Tegucigalpa'),
(UUID(),'America/Thule'),
(UUID(),'America/Thunder_Bay'),
(UUID(),'America/Tijuana'),
(UUID(),'America/Toronto'),
(UUID(),'America/Tortola'),
(UUID(),'America/Vancouver'),
(UUID(),'America/Virgin'),
(UUID(),'America/Whitehorse'),
(UUID(),'America/Winnipeg'),
(UUID(),'America/Yakutat'),
(UUID(),'America/Yellowknife'),
(UUID(),'Antarctica/Casey'),
(UUID(),'Antarctica/Davis'),
(UUID(),'Antarctica/DumontDUrville'),
(UUID(),'Antarctica/Macquarie'),
(UUID(),'Antarctica/Mawson'),
(UUID(),'Antarctica/McMurdo'),
(UUID(),'Antarctica/Palmer'),
(UUID(),'Antarctica/Rothera'),
(UUID(),'Antarctica/South_Pole'),
(UUID(),'Antarctica/Syowa'),
(UUID(),'Antarctica/Vostok'),
(UUID(),'Arctic/Longyearbyen'),
(UUID(),'Asia/Aden'),
(UUID(),'Asia/Almaty'),
(UUID(),'Asia/Amman'),
(UUID(),'Asia/Anadyr'),
(UUID(),'Asia/Aqtau'),
(UUID(),'Asia/Aqtobe'),
(UUID(),'Asia/Ashgabat'),
(UUID(),'Asia/Ashkhabad'),
(UUID(),'Asia/Baghdad'),
(UUID(),'Asia/Bahrain'),
(UUID(),'Asia/Baku'),
(UUID(),'Asia/Bangkok'),
(UUID(),'Asia/Beirut'),
(UUID(),'Asia/Bishkek'),
(UUID(),'Asia/Brunei'),
(UUID(),'Asia/Calcutta'),
(UUID(),'Asia/Choibalsan'),
(UUID(),'Asia/Chongqing'),
(UUID(),'Asia/Chungking'),
(UUID(),'Asia/Colombo'),
(UUID(),'Asia/Dacca'),
(UUID(),'Asia/Damascus'),
(UUID(),'Asia/Dhaka'),
(UUID(),'Asia/Dili'),
(UUID(),'Asia/Dubai'),
(UUID(),'Asia/Dushanbe'),
(UUID(),'Asia/Gaza'),
(UUID(),'Asia/Harbin'),
(UUID(),'Asia/Ho_Chi_Minh'),
(UUID(),'Asia/Hong_Kong'),
(UUID(),'Asia/Hovd'),
(UUID(),'Asia/Irkutsk'),
(UUID(),'Asia/Istanbul'),
(UUID(),'Asia/Jakarta'),
(UUID(),'Asia/Jayapura'),
(UUID(),'Asia/Jerusalem'),
(UUID(),'Asia/Kabul'),
(UUID(),'Asia/Kamchatka'),
(UUID(),'Asia/Karachi'),
(UUID(),'Asia/Kashgar'),
(UUID(),'Asia/Kathmandu'),
(UUID(),'Asia/Katmandu'),
(UUID(),'Asia/Kolkata'),
(UUID(),'Asia/Krasnoyarsk'),
(UUID(),'Asia/Kuala_Lumpur'),
(UUID(),'Asia/Kuching'),
(UUID(),'Asia/Kuwait'),
(UUID(),'Asia/Macao'),
(UUID(),'Asia/Macau'),
(UUID(),'Asia/Magadan'),
(UUID(),'Asia/Makassar'),
(UUID(),'Asia/Manila'),
(UUID(),'Asia/Muscat'),
(UUID(),'Asia/Nicosia'),
(UUID(),'Asia/Novokuznetsk'),
(UUID(),'Asia/Novosibirsk'),
(UUID(),'Asia/Omsk'),
(UUID(),'Asia/Oral'),
(UUID(),'Asia/Phnom_Penh'),
(UUID(),'Asia/Pontianak'),
(UUID(),'Asia/Pyongyang'),
(UUID(),'Asia/Qatar'),
(UUID(),'Asia/Qyzylorda'),
(UUID(),'Asia/Rangoon'),
(UUID(),'Asia/Riyadh'),
(UUID(),'Asia/Saigon'),
(UUID(),'Asia/Sakhalin'),
(UUID(),'Asia/Samarkand'),
(UUID(),'Asia/Seoul'),
(UUID(),'Asia/Shanghai'),
(UUID(),'Asia/Singapore'),
(UUID(),'Asia/Taipei'),
(UUID(),'Asia/Tashkent'),
(UUID(),'Asia/Tbilisi'),
(UUID(),'Asia/Tehran'),
(UUID(),'Asia/Tel_Aviv'),
(UUID(),'Asia/Thimbu'),
(UUID(),'Asia/Thimphu'),
(UUID(),'Asia/Tokyo'),
(UUID(),'Asia/Ujung_Pandang'),
(UUID(),'Asia/Ulaanbaatar'),
(UUID(),'Asia/Ulan_Bator'),
(UUID(),'Asia/Urumqi'),
(UUID(),'Asia/Vientiane'),
(UUID(),'Asia/Vladivostok'),
(UUID(),'Asia/Yakutsk'),
(UUID(),'Asia/Yekaterinburg'),
(UUID(),'Asia/Yerevan'),
(UUID(),'Atlantic/Azores'),
(UUID(),'Atlantic/Bermuda'),
(UUID(),'Atlantic/Canary'),
(UUID(),'Atlantic/Cape_Verde'),
(UUID(),'Atlantic/Faeroe'),
(UUID(),'Atlantic/Faroe'),
(UUID(),'Atlantic/Jan_Mayen'),
(UUID(),'Atlantic/Madeira'),
(UUID(),'Atlantic/Reykjavik'),
(UUID(),'Atlantic/South_Georgia'),
(UUID(),'Atlantic/St_Helena'),
(UUID(),'Atlantic/Stanley'),
(UUID(),'Australia/ACT'),
(UUID(),'Australia/Adelaide'),
(UUID(),'Australia/Brisbane'),
(UUID(),'Australia/Broken_Hill'),
(UUID(),'Australia/Canberra'),
(UUID(),'Australia/Currie'),
(UUID(),'Australia/Darwin'),
(UUID(),'Australia/Eucla'),
(UUID(),'Australia/Hobart'),
(UUID(),'Australia/LHI'),
(UUID(),'Australia/Lindeman'),
(UUID(),'Australia/Lord_Howe'),
(UUID(),'Australia/Melbourne'),
(UUID(),'Australia/North'),
(UUID(),'Australia/NSW'),
(UUID(),'Australia/Perth'),
(UUID(),'Australia/Queensland'),
(UUID(),'Australia/South'),
(UUID(),'Australia/Sydney'),
(UUID(),'Australia/Tasmania'),
(UUID(),'Australia/Victoria'),
(UUID(),'Australia/West'),
(UUID(),'Australia/Yancowinna'),
(UUID(),'Brazil/Acre'),
(UUID(),'Brazil/DeNoronha'),
(UUID(),'Brazil/East'),
(UUID(),'Brazil/West'),
(UUID(),'Canada/Atlantic'),
(UUID(),'Canada/Central'),
(UUID(),'Canada/East-Saskatchewan'),
(UUID(),'Canada/Eastern'),
(UUID(),'Canada/Mountain'),
(UUID(),'Canada/Newfoundland'),
(UUID(),'Canada/Pacific'),
(UUID(),'Canada/Saskatchewan'),
(UUID(),'Canada/Yukon'),
(UUID(),'CET'),
(UUID(),'Chile/Continental'),
(UUID(),'Chile/EasterIsland'),
(UUID(),'CST6CDT'),
(UUID(),'Cuba'),
(UUID(),'EET'),
(UUID(),'Egypt'),
(UUID(),'Eire'),
(UUID(),'EST'),
(UUID(),'EST5EDT'),
(UUID(),'Etc/GMT'),
(UUID(),'Etc/GMT+0'),
(UUID(),'Etc/GMT+1'),
(UUID(),'Etc/GMT+10'),
(UUID(),'Etc/GMT+11'),
(UUID(),'Etc/GMT+12'),
(UUID(),'Etc/GMT+2'),
(UUID(),'Etc/GMT+3'),
(UUID(),'Etc/GMT+4'),
(UUID(),'Etc/GMT+5'),
(UUID(),'Etc/GMT+6'),
(UUID(),'Etc/GMT+7'),
(UUID(),'Etc/GMT+8'),
(UUID(),'Etc/GMT+9'),
(UUID(),'Etc/GMT-0'),
(UUID(),'Etc/GMT-1'),
(UUID(),'Etc/GMT-10'),
(UUID(),'Etc/GMT-11'),
(UUID(),'Etc/GMT-12'),
(UUID(),'Etc/GMT-13'),
(UUID(),'Etc/GMT-14'),
(UUID(),'Etc/GMT-2'),
(UUID(),'Etc/GMT-3'),
(UUID(),'Etc/GMT-4'),
(UUID(),'Etc/GMT-5'),
(UUID(),'Etc/GMT-6'),
(UUID(),'Etc/GMT-7'),
(UUID(),'Etc/GMT-8'),
(UUID(),'Etc/GMT-9'),
(UUID(),'Etc/GMT0'),
(UUID(),'Etc/Greenwich'),
(UUID(),'Etc/UCT'),
(UUID(),'Etc/Universal'),
(UUID(),'Etc/UTC'),
(UUID(),'Etc/Zulu'),
(UUID(),'Europe/Amsterdam'),
(UUID(),'Europe/Andorra'),
(UUID(),'Europe/Athens'),
(UUID(),'Europe/Belfast'),
(UUID(),'Europe/Belgrade'),
(UUID(),'Europe/Berlin'),
(UUID(),'Europe/Bratislava'),
(UUID(),'Europe/Brussels'),
(UUID(),'Europe/Bucharest'),
(UUID(),'Europe/Budapest'),
(UUID(),'Europe/Chisinau'),
(UUID(),'Europe/Copenhagen'),
(UUID(),'Europe/Dublin'),
(UUID(),'Europe/Gibraltar'),
(UUID(),'Europe/Guernsey'),
(UUID(),'Europe/Helsinki'),
(UUID(),'Europe/Isle_of_Man'),
(UUID(),'Europe/Istanbul'),
(UUID(),'Europe/Jersey'),
(UUID(),'Europe/Kaliningrad'),
(UUID(),'Europe/Kiev'),
(UUID(),'Europe/Lisbon'),
(UUID(),'Europe/Ljubljana'),
(UUID(),'Europe/London'),
(UUID(),'Europe/Luxembourg'),
(UUID(),'Europe/Madrid'),
(UUID(),'Europe/Malta'),
(UUID(),'Europe/Mariehamn'),
(UUID(),'Europe/Minsk'),
(UUID(),'Europe/Monaco'),
(UUID(),'Europe/Moscow'),
(UUID(),'Europe/Nicosia'),
(UUID(),'Europe/Oslo'),
(UUID(),'Europe/Paris'),
(UUID(),'Europe/Podgorica'),
(UUID(),'Europe/Prague'),
(UUID(),'Europe/Riga'),
(UUID(),'Europe/Rome'),
(UUID(),'Europe/Samara'),
(UUID(),'Europe/San_Marino'),
(UUID(),'Europe/Sarajevo'),
(UUID(),'Europe/Simferopol'),
(UUID(),'Europe/Skopje'),
(UUID(),'Europe/Sofia'),
(UUID(),'Europe/Stockholm'),
(UUID(),'Europe/Tallinn'),
(UUID(),'Europe/Tirane'),
(UUID(),'Europe/Tiraspol'),
(UUID(),'Europe/Uzhgorod'),
(UUID(),'Europe/Vaduz'),
(UUID(),'Europe/Vatican'),
(UUID(),'Europe/Vienna'),
(UUID(),'Europe/Vilnius'),
(UUID(),'Europe/Volgograd'),
(UUID(),'Europe/Warsaw'),
(UUID(),'Europe/Zagreb'),
(UUID(),'Europe/Zaporozhye'),
(UUID(),'Europe/Zurich'),
(UUID(),'Factory'),
(UUID(),'GB'),
(UUID(),'GB-Eire'),
(UUID(),'GMT'),
(UUID(),'GMT+0'),
(UUID(),'GMT-0'),
(UUID(),'GMT0'),
(UUID(),'Greenwich'),
(UUID(),'Hongkong'),
(UUID(),'HST'),
(UUID(),'Iceland'),
(UUID(),'Indian/Antananarivo'),
(UUID(),'Indian/Chagos'),
(UUID(),'Indian/Christmas'),
(UUID(),'Indian/Cocos'),
(UUID(),'Indian/Comoro'),
(UUID(),'Indian/Kerguelen'),
(UUID(),'Indian/Mahe'),
(UUID(),'Indian/Maldives'),
(UUID(),'Indian/Mauritius'),
(UUID(),'Indian/Mayotte'),
(UUID(),'Indian/Reunion'),
(UUID(),'Iran'),
(UUID(),'Israel'),
(UUID(),'Jamaica'),
(UUID(),'Japan'),
(UUID(),'Kwajalein'),
(UUID(),'Libya'),
(UUID(),'MET'),
(UUID(),'Mexico/BajaNorte'),
(UUID(),'Mexico/BajaSur'),
(UUID(),'Mexico/General'),
(UUID(),'MST'),
(UUID(),'MST7MDT'),
(UUID(),'Navajo'),
(UUID(),'NZ'),
(UUID(),'NZ-CHAT'),
(UUID(),'Pacific/Apia'),
(UUID(),'Pacific/Auckland'),
(UUID(),'Pacific/Chatham'),
(UUID(),'Pacific/Chuuk'),
(UUID(),'Pacific/Easter'),
(UUID(),'Pacific/Efate'),
(UUID(),'Pacific/Enderbury'),
(UUID(),'Pacific/Fakaofo'),
(UUID(),'Pacific/Fiji'),
(UUID(),'Pacific/Funafuti'),
(UUID(),'Pacific/Galapagos'),
(UUID(),'Pacific/Gambier'),
(UUID(),'Pacific/Guadalcanal'),
(UUID(),'Pacific/Guam'),
(UUID(),'Pacific/Honolulu'),
(UUID(),'Pacific/Johnston'),
(UUID(),'Pacific/Kiritimati'),
(UUID(),'Pacific/Kosrae'),
(UUID(),'Pacific/Kwajalein'),
(UUID(),'Pacific/Majuro'),
(UUID(),'Pacific/Marquesas'),
(UUID(),'Pacific/Midway'),
(UUID(),'Pacific/Nauru'),
(UUID(),'Pacific/Niue'),
(UUID(),'Pacific/Norfolk'),
(UUID(),'Pacific/Noumea'),
(UUID(),'Pacific/Pago_Pago'),
(UUID(),'Pacific/Palau'),
(UUID(),'Pacific/Pitcairn'),
(UUID(),'Pacific/Pohnpei'),
(UUID(),'Pacific/Ponape'),
(UUID(),'Pacific/Port_Moresby'),
(UUID(),'Pacific/Rarotonga'),
(UUID(),'Pacific/Saipan'),
(UUID(),'Pacific/Samoa'),
(UUID(),'Pacific/Tahiti'),
(UUID(),'Pacific/Tarawa'),
(UUID(),'Pacific/Tongatapu'),
(UUID(),'Pacific/Truk'),
(UUID(),'Pacific/Wake'),
(UUID(),'Pacific/Wallis'),
(UUID(),'Pacific/Yap'),
(UUID(),'Poland'),
(UUID(),'Portugal'),
(UUID(),'PRC'),
(UUID(),'PST8PDT'),
(UUID(),'ROC'),
(UUID(),'ROK'),
(UUID(),'Singapore'),
(UUID(),'Turkey'),
(UUID(),'UCT'),
(UUID(),'Universal'),
(UUID(),'US/Alaska'),
(UUID(),'US/Aleutian'),
(UUID(),'US/Arizona'),
(UUID(),'US/Central'),
(UUID(),'US/East-Indiana'),
(UUID(),'US/Eastern'),
(UUID(),'US/Hawaii'),
(UUID(),'US/Indiana-Starke'),
(UUID(),'US/Michigan'),
(UUID(),'US/Mountain'),
(UUID(),'US/Pacific'),
(UUID(),'US/Pacific-New'),
(UUID(),'US/Samoa'),
(UUID(),'UTC'),
(UUID(),'W-SU'),
(UUID(),'WET'),
(UUID(),'Zulu');
