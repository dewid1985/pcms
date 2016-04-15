<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.06.15
 * Time: 11:43
 */

include(getcwd() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin_config.inc.php');

class ImportImages
{
    use StringHelper;

    public static function create()
    {
        return new static();
    }

    /**
     * @return Module
     */
    private function getModule()
    {
        return Module::create()->setModule(ModulesEnum::multimedia());
    }

    public function import()
    {
        Logger::me()
            ->setLevel(LogLevel::finest())
            ->add(
                GrayLogLogger2::create(GraylogPublisher::create(GRAYLOG_HOST))
                    ->setFacility(':AdminPanel')
            );

        $link = DBPool::me()->getLink();

        $link->begin();

        try {
            foreach (Criteria::create(MultimediaUnsorted::dao())->getList() as $object) {
                /**@var MultimediaUnsorted $object */

                $imagePaht = '/home/image/pravda.ru/photo/unsorted/' . $object->getId() . '.jpeg';

                $request = ModuleMultimediaAddImageOperationRequest::create();

                $request
                    ->setName($this->transliterate($object->getTitle()))
                    ->setTitle($object->getTitle())
                    ->setDescription($object->getDescription())
                    ->setTags($object->getTags())
                    ->setUploadedAt($object->getCreatedAt());

                if (file_exists($imagePaht)) {
                    $request->setImages(['tmp_name' => $imagePaht, 'type' => 'image/jpeg']);
                    $this->getModule()->getModuleObject()->setRequest($request);
                    $this->getModule()->init(MultimediaOperationEnum::addImage());
                } else continue;
            }

            $link->commit();

        } catch (Exception $e) {
            Logger::me()->exception($e);
            $link->rollback();
        }
    }
}

ImportImages::create()->import();