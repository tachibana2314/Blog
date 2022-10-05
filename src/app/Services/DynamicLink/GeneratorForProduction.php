<?php

namespace App\Services\DynamicLink;


use Kreait\Firebase\DynamicLinks;

class GeneratorForProduction implements GeneratorInterface
{
    private $firebase;

    public function __construct(DynamicLinks $firebase)
    {
        $this->firebase = $firebase;
    }

    public function generate($id)
    {
        $parameters = [
            'dynamicLinkInfo' => [
                'domainUriPrefix' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
                'link' =>'https://sg.chateraise-i.com/links/?&efr=1&page=product&id='.$id,
                'iosInfo' => [
                    "iosBundleId" => "co.getz.chateraisesg",
                    "iosFallbackLink"  => 'https://sg.chateraise-i.com/links/?&efr=1&page=product&id='.$id,
                    "iosCustomScheme" => "chateraise-app-sg",
                    "iosAppStoreId" => "1560078823"
                ],
                'androidInfo' => [
                    "androidPackageName" => "co.getz.chateraisesg",
                    // "androidFallbackLink"  => string,アプリがインストールされていないときに開くリンク。
                    // "androidMinPackageVersionCode" => string,インストールされているアプリが古いバージョンの場合、ユーザーはPlayストアに移動してアプリをアップグレードします
                ],
            ],
            'suffix' => ['option' => 'UNGUESSABLE'],
        ];

        return $this->firebase->createDynamicLink($parameters);
    }
}
