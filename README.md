# Perfume Of The Day

I love perfumes! And I log what I wear daily on [Parfumo](https://www.parfumo.com), a perfume community site I really love. This is a small PHP script that simply loads my Parfumo profile page and gets the current perfume, then loads the perfume's entry and gets the perfume name and perfume brand. Then it prints out JSON for easy inclusion on my website. Easy as that!

Please don't abuse this script. I figure that with the very little traffic I get to my personal website, querying Parfumo twice with every visit to my "About" page isn't going to be any kind of taxing.

## Packages Used

- [hQuery.php](https://github.com/duzun/hQuery.php)
  - Fast and efficient web scraper for PHP


## Endpoint

- `/get.php` GET request that returns JSON of the currently worn perfume
```
{
  "active": true or false, // false if there is no currently worn perfume
  "brand": "String of perfume brand",
  "perfume": "String of perfume name",
  "url": "String of perfume URL on Parfumo"
}
```

---

Developed by Alexandria 'Hannah' I. Patellis, starting in 2026

[hannahap.com](https://hannahap.com)