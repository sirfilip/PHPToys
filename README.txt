Monkey Island API
=================

1. In order to examine or extend Monkey Island API you should checkout the
  routes.php file located inside app folder. It is a php associative array 
  which has routes as keys and functions as callbacks.

  A callback can return either a text or a Response object.

Benchmarks
==========

)ab -n 1000 -c 100 http://localhost:8000/api/cuddly_toys/dogs/
This is ApacheBench, Version 2.3 <$Revision: 1528965 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking localhost (be patient)
Completed 100 requests
Completed 200 requests
Completed 300 requests
Completed 400 requests
Completed 500 requests
Completed 600 requests
Completed 700 requests
Completed 800 requests
Completed 900 requests
Completed 1000 requests
Finished 1000 requests


Server Software:        
Server Hostname:        localhost
Server Port:            8000

Document Path:          /api/cuddly_toys/dogs/
Document Length:        225 bytes

Concurrency Level:      100
Time taken for tests:   0.908 seconds
Complete requests:      1000
Failed requests:        0
Total transferred:      353000 bytes
HTML transferred:       225000 bytes
Requests per second:    1100.91 [#/sec] (mean)
Time per request:       90.834 [ms] (mean)
Time per request:       0.908 [ms] (mean, across all concurrent requests)
Transfer rate:          379.51 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   1.2      0       5
Processing:     2   86  14.9     90      92
Waiting:        2   86  14.9     90      92
Total:          7   86  13.8     90      95

Percentage of the requests served within a certain time (ms)
  50%     90
  66%     90
  75%     90
  80%     90
  90%     90
  95%     90
  98%     91
  99%     91
 100%     95 (longest request)
