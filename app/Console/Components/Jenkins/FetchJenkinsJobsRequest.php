<?php

namespace App\Console\Components\Jenkins;

use App\Events\Jenkins\JobsFetched;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchJenkinsJobsRequest extends Command
{
    protected $signature = 'dashboard:fetch-jenkins-jobs-request';

    protected $description = 'Fetch Jenkins job request';

    public function handle()
    {
        $this->info('Fetch Jenkins job request ...');

        $url = env('JENKINS_HOST');

        $client = new Client();
        $response = $client->get($url.'/api/json', [
            'auth' => [
                env('JENKINS_USER'),
                env('JENKINS_TOKEN'),
            ]
        ]);
        $jenkinsJobs = json_decode((string)$response->getBody(), true);

        $jobs = array_map(function ($element) use ($url) {
            return [
                'icon' => $url.'/static/ef59f95e/images/16x16/'.$element['color'].'.gif',
                'name' => $element['name'],
            ];
        }, $jenkinsJobs['jobs']);

        event(new JobsFetched($jobs));

        $this->info('All done!');
    }
}
