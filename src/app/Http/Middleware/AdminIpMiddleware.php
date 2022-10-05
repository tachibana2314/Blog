<?php

    namespace App\Http\Middleware;

    use Closure;
    use \Illuminate\Http\Response;
    use \Illuminate\Http\Request;
use Storage;

class AdminIpMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next)
        {
            $ips = [
                '153.242.189.16',
                '100.64.1.41',
                '183.77.255.75', // SoushinLabOffice
                '113.33.218.90', // SoushinLabOffice
                '153.143.56.33', // Chateraise
                '202.131.196.21', // Chateraise
                '202.131.196.22', // Chateraise
                '3.16.84.215', // Chateraise
                '206.55.101.210', // Chateraise
                '206.55.101.211', // Chateraise
                '206.55.101.212', // Chateraise
                '206.55.101.213', // Chateraise
                '206.55.101.214', // Chateraise
                '206.55.101.215', // Chateraise
                '206.55.101.216', // Chateraise
                '206.55.101.217', // Chateraise
                '206.55.101.218', // Chateraise
                '206.55.101.219', // Chateraise
                '206.55.101.220', // Chateraise
                '206.55.101.221', // Chateraise
                '206.55.101.222', // Chateraise
                '206.55.101.223', // Chateraise
                '206.55.101.224', // Chateraise
                '206.55.101.225', // Chateraise
                '206.55.101.226', // Chateraise
                '206.55.101.227', // Chateraise
                '206.55.101.228', // Chateraise
                '206.55.101.229', // Chateraise
                '206.55.101.230', // Chateraise
                '206.55.101.231', // Chateraise
                '206.55.101.232', // Chateraise
                '206.55.101.233', // Chateraise
                '206.55.101.234', // Chateraise
                '206.55.101.235', // Chateraise
                '206.55.101.236', // Chateraise
                '206.55.101.237', // Chateraise
                '206.55.101.238', // Chateraise
                '206.55.101.239', // Chateraise
                '206.55.101.240', // Chateraise
                '206.55.101.241', // Chateraise
                '206.55.101.242', // Chateraise
                '206.55.101.243', // Chateraise
                '206.55.101.244', // Chateraise
                '206.55.101.245', // Chateraise
                '3.112.23.168', // Chateraise
                '3.112.23.169', // Chateraise
                '3.112.23.170', // Chateraise
                '3.112.23.171', // Chateraise
                '3.112.23.172', // Chateraise
                '3.112.23.173', // Chateraise
                '3.112.23.174', // Chateraise
                '3.112.23.175', // Chateraises
                '210.136.82.112', // Chateraises
                '210.136.82.113', // Chateraises
            ];

            $ip = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : null;
            if (!$ip) {
                $ip = $_SERVER["REMOTE_ADDR"];
            }

            if (
                !in_array($ip, $ips)
            ) { abort(403);
            }
            return $next($request);
        }
    }
