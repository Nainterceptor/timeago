S4aTimeAgoBundle
================

This simple bundle exist to provide a simple date to string conversion like "few seconds ago"...

# How to install

Please add in your composer dependencies :

    "spider4all/timeagobundle": "dev-master"

Please launch php composer.phar update

Please add to your AppKernel.php :

    new S4a\TimeAgoBundle\S4aTimeAgoBundle(),

# How to use

    date|timeago[(now[, timezone])]


First parameter : Actual date (to simulate the view at day X)
Second parameter : Timezone

## Configure Timezone

Override s4a_time_ago.timezone parameter to change default timezone (Europe/Paris)