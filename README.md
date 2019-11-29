<p align="center">
  <img width="128" height="128" src="https://github.com/kmrtylmz/FileTagManager-PHP/blob/master/public/images/FileTagManager.svg">
</p>

# File Tag Manager 
- [Download](#download)
- [Açıklama](#açıklama)
  * [Nasıl Çalışır ?](#nasıl-çalışır)
  * [Kurallar](#kurallar)
  * [Screenshots](#screenshots)
- [Geliştirme Ortamı](#geliştirme-ortamı)

### Download
------------

[In Here](http://google.com "Burayı")  tıklayarak  download edin. // Will be include <br/>
Yükleme adımlarını  Next diyerek **Run** edin. İşte bu kadar basit.<br/>


### Açıklama

Şuan için *Windows* da kullanılabilir  executable versiyon bulunmaktadır. [V1.0][v1.0] &hearts;<br/>

#### Nasıl Çalışır 

------------
- Dosyalarınıza istediğiniz etiketi verin. 

- Artık dosya adlarını değil etiketleri aklınızda tutun. 

- Görünce hatırlarım diyorsanız , sizin için bir liste geliyor olacak.

     > Bunu nereye koymuştum? :expressionless:  dediğiniz dosyalarınızı yönetmek artık basit.

- Etiket verdiğiniz dosyalarınız artık nereye giderlerse gitsinler bulabilirsiniz.

- Dosya yolunuzu kopyalayın ve etiketleyin.

- Merak etme bunun için yazılmış gizli bir komut dosyası da oluyor olacak.


#### Kurallar
----------

- 1 Etikete 1 den fazla dosya tanımlanabilir. 
- 1 Dosya 1 den fazla etikete tanımlanamaz.


#### Screenshots
----------
![](https://github.com/kmrtylmz/FileTagManager-PHP/blob/master/public/screenshots/findoriginalpath.png)
![](https://github.com/kmrtylmz/FileTagManager-PHP/blob/master/public/screenshots/searchingfile.png)


`Show more in` [here](https://github.com/kmrtylmz/FileTagManager-PHP/tree/master/public/screenshots)


### Geliştirme Ortamı
----------


Uygulama  cztomczak'ın  phpdesktop projesi ile geliştirilmiştir. HTML + JS + CSS ile  Elektron sayesinde desktop gui uygulamaları yazılabiliyorken [Slack, Atom vb] PHP ile neden yapılmasın sorusuna alternatiftir. Bununla ilgili bir kaç atılımlar olmuş ancak şuan için döküman ve last commitlere bakarak tercihimi bundan yana kullandım. 

Düşük bellek kullanımı dikkat çekiyor. Ortamda Mongoose + HTML + JS + CSS + PHP [Derlenmiş bazı extensinoslarla ] + Chromium + Sqlite Database ile  PHP' yi bir masaüstü GUI araçlarını kullanırcasına kullanma , executable formatte taşınabilir yapma ve native kullanmaya teşvik etmiş olmasıdır. Tabiki bunlara Mysql vb. olaylar eklenebilir. Ama serviceslerin başlatılması ve taşınması kasıntılı diye arkadaş yanaşmamış.

Kendine ait bir setting dosyası var ve configuration edilebiliyor.  Kendisi ne kadar open-source kaynak kullanıp geliştirme yaptıysa da projeyi de open-source salmıştır. Ticari kullanım için ücretsizdir. Ve yana yakıla donate ve sponsor aramaktadır.

Aslında son zamanlarda bir proje yapmak tam zamanımdı ve bununla geliştirmek istedim. Sistem kaynaklarına erişmek, OOP de kendimi denemek, MVC çatısı kurmak , Sqlite deneyimi yaşamak , Shell komutlarıyla çalışmak ve exe formatında çalışmak hedefimdi. Sanırım bunu başardım.

Ek olarak Mongoose web server kullanıldığını unutmayın .htaccess dosyasının çalışmayacağını anlamanız gerekiyor. Ayrıca url uzantılarıyla ilgili değişik sürprizler sizleri bekliyor olacak :smiley:  Bir atılım yapmak istiyorsanız ilk önce wiki sayfasından başlayın derim. Ardından bu projeyi inceleyin.



## LICENSE 

See [ MIT ][mit]

[mit]: <https://github.com/kmrtylmz/FileTagManager-PHP/blob/master/LICENSE/>
[v1.0]: <https://github.com/kmrtylmz/FileTagManager-PHP/releases>
