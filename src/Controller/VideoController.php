<?php



namespace App\Controller;

use App\Controller\Datatime;
use App\Entity\Video;
use App\Service\CoreService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

ini_set('max_execution_time', 1500);

class VideoController extends AbstractController
{
    public function index(Request $request)
    {
        $service = new CoreService();
        $data = $service->initParse();
        foreach ($data as $item) {
            $video = new Video();
            $em = $this->getDoctrine()->getManager();
            $video->setVideoTitle($item['video_title'])
                  ->setTime(new \Datetime('now'))
                  ->setStatus($this->getDoctrine()->getRepository(Video::class)->findAllBySource("https://www.youtube.com/watch?v=".$item['video_source']))
                  ->setVideoDescription($item['video_description'])
                  ->setVideoPreview("https://lexani.com/img/".$item['video_preview'])
                  ->setVideoSource("https://www.youtube.com/watch?v=".$item['video_source'])
                  ->setUserIp($request->getClientIp())
                  ->setUserAgent($request->headers->get("User-Agent"));
            $em->persist($video);
            $compare = $this->getDoctrine()->getRepository(Video::class)->findBy(['video_source'=> $video->getVideoSource()]);
            $em->flush();
        }
        $videos = $this->getDoctrine()->getRepository(Video::class)->findAll();
        $export = $service->initCSV($videos);
        return $this->render('video/index.html.twig', ['videos' => $videos]);
    }
}