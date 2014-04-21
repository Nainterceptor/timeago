<?php
namespace S4a\TimeAgoBundle\Lib;

/**
 * Class TimeAgo
 * @package S4a\TimeAgoBundle\Lib
 */
class TimeAgo {

    /**
     * Prefix for
     */
    const I18N_PREFIX = 's4a.timeago';
    /**
     * The current timezone
     *
     * @var \DateTimeZone
     */
    protected $timezone;

    /**
     * Set timezone
     *
     * @param string|null $timezone
     */
    public function __construct($timezone = null) {
        try {
            $this->timezone = new \DateTimeZone($timezone);
        } catch (\Exception $e) {
            $this->timezone = new \DateTimeZone('Europe/Paris');
        }
    }

    /**
     * Return date in few words
     *
     * @param $past
     * @param string $now
     * @return array
     */
    public function inWords($past, $now = 'now')
    {
        if (!($past instanceof \DateTime)) {
            $past = new \DateTime($past);
        }

        if (!($now instanceof \DateTime)) {
            $now = new \DateTime($now, $this->timezone);
        }

        $interval = $now->diff($past);
        $totalSeconds = $interval->days * 86400
            + $interval->h * 3600
            + $interval->i * 60
            + $interval->s;

        if($totalSeconds < 30) { // less than 29secs
            return self::i18lReturn('second', $interval->s, $interval->invert);
        } elseif ($totalSeconds < (45 * 60)) {
            return self::i18lReturn('minute', $interval->i, $interval->invert);
        } elseif ($totalSeconds < (24 * 60 * 60)) {
            return self::i18lReturn('hour', $interval->h, $interval->invert);
        } elseif ($interval->days < 30) {
            return self::i18lReturn('day', $interval->d, $interval->invert);
        } elseif ($interval->days < 365) {
            return self::i18lReturn('month', $interval->m, $interval->invert);
        } else {
            return self::i18lReturn('year', $interval->y, $interval->invert);
        }
    }

    /**
     * Format response
     *
     * @param $shortkey
     * @param int $number
     * @param int $isInPast
     * @return array
     */
    protected static function i18lReturn ($shortkey, $number = 1, $isInPast = 1)
    {
        return array(self::I18N_PREFIX . ($isInPast ? '.since.' : '.in.') . $shortkey, $number);
    }

    /**
     * Simple between test
     *
     * @param $toTest
     * @param $max
     * @param $min
     * @return bool
     */
    protected function betweenInc ($toTest, $min, $max)
    {
        return $toTest >= $min && $toTest <= $max;
    }
}