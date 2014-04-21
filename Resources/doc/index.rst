S4aTimeAgoBundle
================

This simple bundle exist to provide a simple date to string conversion like "few seconds ago"...

.. code-block:: jinja

    date|timeago


First parameter : Actual date (to simulate the view at day X)
Second parameter : Timezone

Override s4a_time_ago.timezone parameter to change default timezone (Europe/Paris)