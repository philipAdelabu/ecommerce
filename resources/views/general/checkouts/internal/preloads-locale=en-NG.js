
    (function() {
      var baseURL = "https://cdn.shopify.com/shopifycloud/checkout-web/assets/";
      var scripts = ["https://cdn.shopify.com/shopifycloud/checkout-web/assets/runtime.baseline.en.fc1ec945cd6061429a5c.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/8919.baseline.en.80e41116101b4100f611.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/7538.baseline.en.c95fb42b6a26bad96a36.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/4085.baseline.en.22d76211a9970908eac0.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.baseline.en.ecb9e89e09184eddffa6.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/2542.baseline.en.7ec3164fc01d10bbabc6.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/5019.baseline.en.723e311f4a05eaa581cf.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/4788.baseline.en.65e875c67b80d26b3869.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/2080.baseline.en.4108502d9f2c1ca7f6c3.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/145.baseline.en.27bff5374f9a8fabb40b.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/434.baseline.en.595601998601575ab023.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/8096.baseline.en.05480ca7e096f0f1b2b6.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/8398.baseline.en.0d4204656166c50114a6.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/4619.baseline.en.09fd2ff6f0887d1747a1.js","https://cdn.shopify.com/shopifycloud/checkout-web/assets/OnePage.baseline.en.2cf87d3ec3c0363c0fec.js"];
      var styles = ["https://cdn.shopify.com/shopifycloud/checkout-web/assets/8919.baseline.en.12cb507e6cdf2badd707.css","https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.baseline.en.44428467e736b1c925f1.css","https://cdn.shopify.com/shopifycloud/checkout-web/assets/6268.baseline.en.b43fa0e7db0766e44946.css"];
      var fontPreconnectUrls = [];
      var fontPrefetchUrls = [];
      var imgPrefetchUrls = ["https://cdn.shopify.com/s/files/1/1912/5817/files/logo_x320.png?v=1684140691"];

      function preconnect(url, callback) {
        var link = document.createElement('link');
        link.rel = 'dns-prefetch preconnect';
        link.href = url;
        link.crossOrigin = '';
        link.onload = link.onerror = callback;
        document.head.appendChild(link);
      }

      function preconnectAssets() {
        var resources = [baseURL].concat(fontPreconnectUrls);
        var index = 0;
        (function next() {
          var res = resources[index++];
          if (res) preconnect(res, next);
        })();
      }

      function prefetch(url, as, callback) {
        var link = document.createElement('link');
        if (link.relList.supports('prefetch')) {
          link.rel = 'prefetch';
          link.fetchPriority = 'low';
          link.as = as;
          if (as === 'font') link.type = 'font/woff2';
          link.href = url;
          link.crossOrigin = '';
          link.onload = link.onerror = callback;
          document.head.appendChild(link);
        } else {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', url, true);
          xhr.onloadend = callback;
          xhr.send();
        }
      }

      function prefetchAssets() {
        var resources = [].concat(
          scripts.map(function(url) { return [url, 'script']; }),
          styles.map(function(url) { return [url, 'style']; }),
          fontPrefetchUrls.map(function(url) { return [url, 'font']; }),
          imgPrefetchUrls.map(function(url) { return [url, 'image']; })
        );
        var index = 0;
        (function next() {
          var res = resources[index++];
          if (res) prefetch(res[0], res[1], next);
        })();
      }

      function onLoaded() {
        preconnectAssets();
        prefetchAssets();
      }

      if (document.readyState === 'complete') {
        onLoaded();
      } else {
        addEventListener('load', onLoaded);
      }
    })();
  