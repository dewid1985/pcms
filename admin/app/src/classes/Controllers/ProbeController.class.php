<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.04.15
 * Time: 11:49
 */
class ProbeController extends ProjectMethodMappedController
{

    public function indexAction(HttpRequest $request)
    {
        $credentials = array(
            'admin',
            'admin'
        );
//
//        // Prepare the file we are going to upload
//        $filename = '07-20-18.jpeg';
//        $filepath = getcwd().'/images/upload/26-03-15/03-17-04/'.$filename;
//        $filesize = filesize($filepath);
//        $fh = fopen($filepath, 'r');
//
//        // The URL where we will upload to, this should be the exact path where the file
//        // is going to be placed
//        $remoteUrl = 'https://admin.shein.pravda.local/webdav/';
//
//        // Initialize cURL and set the options required for the upload. We use the remote
//        // path we specified together with the filename. This will be the result of the
//        // upload.
//        $ch = curl_init($remoteUrl . $filename);
//
//        // I'm setting each option individually so it's easier to debug them when
//        // something goes wrong. When your configuration is done and working well
//        // you can choose to use curl_setopt_array() instead.
//
//        // Set the authentication mode and login credentials
//        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//        curl_setopt($ch, CURLOPT_USERPWD, implode(':', $credentials));
//
//        // Define that we are going to upload a file, by setting CURLOPT_PUT we are
//        // forced to set CURLOPT_INFILE and CURLOPT_INFILESIZE as well.
//        curl_setopt($ch, CURLOPT_PUT, true);
//        curl_setopt($ch, CURLOPT_INFILE, $fh);
//        curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
//
//        // Execute the request, upload the file
//        curl_exec($ch);


//        $filename = getcwd() . '/images/upload/26-03-15/03-17-04/07-20-18.jpeg';
//
//
//        $d = HttpUrl::create()
//            ->setHost('admin.shein.pravda.local')
//            ->setPath('/webdav');
//
////        var_dump($d->toString());
//
//
//        $request
//            ->setFiles([$filename])
//            ->setMethod(HttpMethod::post())
//            ->setUrl($d);
//
//        CurlHttpClient::create()
//            ->setOption('CURLOPT_HTTPAUTH', 'CURLAUTH_BASIC ')
//            ->setOption('CURLOPT_USERPWD','admin:admin')
//            ->setMaxFileSize(1000000)
//            ->send($request);

//        $request->setFiles()

        $filename = '07-20-18.jpeg';
        $filepath = getcwd() . '/images/upload/26-03-15/03-17-04/' . $filename;
        $filesize = filesize($filepath);
        $fh = fopen($filepath,'r');

//$url = 'http://webdav.pravda.local/newCatalog/bla/now/her/blabla1.jpeg';
//        $curl = curl_init();
//
//        curl_setopt($curl, CURLOPT_URL, $url);
////        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
////        curl_setopt($curl, CURLOPT_USERPWD, 'admin:admin');
////        curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_HTTP);
//    //  curl_setopt($curl, CURLOPT_POST, 1);
//
////        $post = array(
////            "file_box" => $filepath,
////        );
////        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
////
//   curl_setopt($curl, CURLOPT_PUT, 1);
//        curl_setopt($curl, CURLOPT_INFILE, $fh);
//       curl_setopt($curl, CURLOPT_INFILESIZE, $filesize);
//       // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//print_r($filesize);
//
//        $data = curl_exec($curl);
//
//        if ($data == false) {
//            echo 'Warning : ' . curl_error($curl);
//            curl_close($curl);
//            die;
//        }
//print_r(curl_getinfo ($curl));
//
//
//        fclose($fh);
//
//
//        WebDav::create()
//            ->setUrl('http://webdav.pravda.local/newCatalog/bla/now/her/bla.jpeg')
//            ->setUser('admin')
//            ->setPassword('admin')
//            ->setOption(CURLOPT_PUT, 1)
//            ->setOption(CURLOPT_INFILE, $fh)
//            ->setOption(CURLOPT_INFILESIZE, $filesize)
//            ->init()
//        ;

//        \Helpers\Uploader\WebDavStore::create()->uploadFile(
//           PlatformFile::create()
//               ->setFileName('2015-04-07/132315/prepared_132315.jpeg')
//               ->setUploadingPath('2015-04-07/132315')
//               ->setFile('2015-04-07/132315/prepared_132315.jpeg')
//        );

        $data = \Helpers\Uploader\WebDavStore::create()->getFile(
            PlatformFile::create()
                ->setFileName('2015-04-07/132315/prepared_132315.jpeg')
        );


//        unlink(\Helpers\Uploader\TmpStore::create()->getPath() . 'test.jpg');
//
//            if (file_exists(\Helpers\Uploader\TmpStore::create()->getPath() . 'test.jpg'))
//            {
//
//            }
//            else {
//                var_dump('no');
//            }
//            ;die;
//        try {
//
//            if (!file_exists(\Helpers\Uploader\TmpStore::create()->getPath() ))
//                mkdir(\Helpers\Uploader\TmpStore::create()->getPath(), 0777, true);
//
//            file_put_contents(\Helpers\Uploader\TmpStore::create()->getPath() . 'test.jpg', $data);
//
//        }catch (Exception $e)
//        {
//            echo ('<pre>');
//            print_r($e);
//        }
//       var_dump(\Helpers\Uploader\WebDavStore::create()->getConfig()->getItem('path'));

//        print_r($fh);
//
//
//
//        fclose($fh);




        $link = DBPool::me()->getLink();

        $link->begin();

        //$c = $link->query();
try {

    print_r(OSQL::select()->get(DBField::create('id','images'))->from(DBTable::create())->toString());
}catch (Exception $e)
{
    print_r($e);
}



        die;
    }

    /**
     * Мапинг методов конроллера
     * Можно вернуть пустой массив если брать с учетом
     * что экшен будет тот который прописан в роут конфиге
     *
     * @return array
     */
    protected function /* array */
    getMapping()
    {
        return [
            'index' => 'indexAction'
        ];
    }
}