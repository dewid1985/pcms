<?php

/**
 * Class GrayLogLogger2
 */
final class GrayLogLogger2 extends BaseLogger
{
    const ENCODING = 'utf8';

    /**
     * @var IGelfPublisher
     */
    protected $publisher;

    /**
     * @var string
     */
    private $facility;

    /**
     * @var array
     */
    protected $levels = array(
        LogLevel::SEVERE => GELFMessage::EMERGENCY,
        LogLevel::WARNING => GELFMessage::WARNING,
        LogLevel::INFO => GELFMessage::INFO,
        LogLevel::CONFIG => GELFMessage::INFO,
        LogLevel::FINE => GELFMessage::NOTICE,
        LogLevel::FINER => GELFMessage::DEBUG,
        LogLevel::FINEST => GELFMessage::DEBUG
    );

    public function __construct (IGelfPublisher $publisher) {
        $this->setPublisher($publisher);
    }

    /**
     * @return GrayLogLogger2
     */
    public static function create (IGelfPublisher $publisher) {
        return new self($publisher);
    }

    /**
     * @return IGelfPublisher
     */
    public function getPublisher () {
        return $this->publisher;
    }

    /**
     * @param IGelfPublisher $publisher
     * @return GrayLogLogger2
     */
    public function setPublisher (IGelfPublisher $publisher) {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @param string $facility
     * @return GrayLogLogger2
     */
    public function setFacility ($facility) {
        $this->facility = $facility;

        return $this;
    }

    protected function publish (LogRecord $record) {
        $this->getPublisher()
            ->send($this->assembleMessage($record));
    }

    /**
     * @param LogRecord $record
     * @return IGelfMessage
     */
    protected function assembleMessage (LogRecord $record) {
            return
            GraylogMessage::create()
                ->setLevel(
                    $this->levels[$record->getLevel()
                        ->getId()]
                )
                ->setHost((isset($_SERVER['SERVER_ADDR'])) ? $_SERVER['SERVER_ADDR'] : gethostname())
                ->setShortMessage(
                    (mb_strlen($record->getMessage(), self::ENCODING) > 100)
                        ? mb_substr($record->getMessage(), 0, 200, self::ENCODING) . ' ...'
                        : $record->getMessage()
                )
                ->setTimestamp(
                    $record->getDate()
                        ->toFormatString('U')
                )
                ->setFacility(
                    $this->facility
                )
                ->setFullMessage($record->getMessage());
    }
}