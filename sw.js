var STATIC_CACHE_NAME="static-v4";
var DYNAMIC_CACHE_NAME="dynamic-v3";
self.addEventListener('install',function(event){
    event.waitUntil(
        caches.open(STATIC_CACHE_NAME)
        .then(function (cache) {
console.log("[Service Worker] PreCaching App Shell ");
cache.addAll(['index.php','offer.php','fride.php','sign_form.php','updateprofile.php','src/js/feed.js','src/js/app.js','src/css/app.css','src/images/output1.webp','src/images/output2.webp',
'src/images/output3.webp','src/images/output4.webp','src/images/output5.webp',
'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
'https://fonts.googleapis.com/css?family=Roboto:800,700',
'https://fonts.googleapis.com/icon?family=Material+Icons',
'https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.teal-blue.min.css',
'https://code.jquery.com/jquery-3.3.1.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js'
,'src/js/app2.js','https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css',
'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css',"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"]);
          })
    );
});
self.addEventListener('activate',function(event){
    event.waitUntil(
        caches.keys().then(
            function (keyList) {
                return Promise.all(keyList.map(function (key) {
                    if(key!==STATIC_CACHE_NAME&&key!==DYNAMIC_CACHE_NAME)
                    {
                        console.log("Removing old cache",key);
                        return caches.delete(key);
                    }
                  }))
              }
        )
    );
    return self.clients.claim();
});
self.addEventListener('fetch',function(event)
{
 event.respondWith(
     caches.match(event.request).
     then(function (response) {
         if(response)
         {
            return response;
         }
         else
         {
             return fetch(event.request).then(
                 function (res) {return caches.open(DYNAMIC_CACHE_NAME).then(
                     function (cache) { cache.put(event.request.url,res.clone());
                    return res; }
                 );  }
             );
         }
     })
     .catch(function(err){})
 );
});