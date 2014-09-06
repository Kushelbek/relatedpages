Related pages
=============

Добавляет возможность привязывать к странице другие страницы 

Установка
---------

В файле **page.add.tpl** тег:

    {PAGEADD_FORM_ADDRELATED}


В файле **page.edit.tpl** тег:

    {PAGEEDIT_FORM_ADDRELATED};

**page.tpl**:
Для вывода связанных страниц: 

    {PAGE_RELATEDPAGES}

или для вывод страниц, с которыми связана данная страница

    {PAGE_RELATEDPAGES_LEFT}
