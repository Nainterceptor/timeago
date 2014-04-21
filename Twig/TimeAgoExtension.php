<?php
namespace S4a\TimeAgoBundle\Twig;

use S4a\TimeAgoBundle\Lib\TimeAgo;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class TimeAgoExtension
 * @package S4a\TimeAgoBundle\Twig
 */
class TimeAgoExtension extends \Twig_Extension
{
    /**
     * Service to Translate words
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $translator;

    /**
     * Default TimeZone from configuration
     * @var string
     */
    protected $timezone;

    /**
     * Load class vars from service manager
     *
     * @param TranslatorInterface $translator
     * @param $timezone
     */
    function __construct(TranslatorInterface $translator, $timezone)
    {
        $this->translator = $translator;
        $this->timezone = $timezone;
    }

    /**
     * List filters of the extension
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'timeago' => new \Twig_Filter_Method($this, 'timeAgoFilter'),
        );
    }

    /**
     * Call lib and return the string.
     *
     * @param $date
     * @param string $now
     * @param null $timezone
     * @return string
     */
    public function timeAgoFilter($date, $now = 'now', $timezone = null)
    {
        if ($timezone == null) {
            $timezone = $this->timezone;
        }
        $timeAgoLib = new TimeAgo($timezone);
        list($key, $number) = $timeAgoLib->inWords($date, $now);

        return $this->translator->transChoice($key, $number, array('%number%' => $number));
    }

    /**
     * Get name of extension
     *
     * @return string
     */
    public function getName()
    {
        return 's4a_timeago_extension';
    }
}