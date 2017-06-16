<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-05-31 13:10:30 --> 404 Page Not Found: /index
ERROR - 2017-05-31 17:30:33 --> 404 Page Not Found: /index
ERROR - 2017-05-31 17:33:22 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-05-31 18:23:40 --> Severity: Warning --> Missing argument 1 for Doc::batch() C:\MJF\web\admin\application\controllers\Doc.php 411
ERROR - 2017-05-31 18:23:40 --> Severity: Warning --> Missing argument 2 for Doc::batch() C:\MJF\web\admin\application\controllers\Doc.php 411
ERROR - 2017-05-31 18:23:40 --> Severity: Notice --> Undefined variable: start C:\MJF\web\admin\application\controllers\Doc.php 412
ERROR - 2017-05-31 18:23:40 --> Severity: Notice --> Undefined variable: end C:\MJF\web\admin\application\controllers\Doc.php 412
ERROR - 2017-05-31 18:23:40 --> Severity: Notice --> Undefined variable: doc_id C:\MJF\web\admin\application\controllers\Doc.php 413
ERROR - 2017-05-31 18:23:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LIMIT 1' at line 15 - Invalid query: SELECT 
    		user_url,
    		doc_ext_name,
            doc_id,
            doc_url, 
            doc_title, 
			substring(doc_content, 1, 250) as doc_desc,
            doc_cate_id,
            doc_user_id,
            doc_dl_forbidden 
            FROM m_doc 
            LEFT JOIN m_user ON doc_user_id = user_id 
            LEFT JOIN m_doc_ext ON m_doc.doc_ext_id = m_doc_ext.doc_ext_id 
            WHERE doc_deleted = 0 
            AND doc_id =  LIMIT 1
ERROR - 2017-05-31 18:23:45 --> Severity: Notice --> Undefined variable: doc_id C:\MJF\web\admin\application\controllers\Doc.php 413
ERROR - 2017-05-31 18:23:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LIMIT 1' at line 15 - Invalid query: SELECT 
    		user_url,
    		doc_ext_name,
            doc_id,
            doc_url, 
            doc_title, 
			substring(doc_content, 1, 250) as doc_desc,
            doc_cate_id,
            doc_user_id,
            doc_dl_forbidden 
            FROM m_doc 
            LEFT JOIN m_user ON doc_user_id = user_id 
            LEFT JOIN m_doc_ext ON m_doc.doc_ext_id = m_doc_ext.doc_ext_id 
            WHERE doc_deleted = 0 
            AND doc_id =  LIMIT 1
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:24:57 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:25:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\MJF\web\admin\system\core\Exceptions.php:271) C:\MJF\web\admin\system\helpers\url_helper.php 564
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 630
ERROR - 2017-05-31 18:26:56 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 631
ERROR - 2017-05-31 18:27:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\MJF\web\admin\system\core\Exceptions.php:271) C:\MJF\web\admin\system\helpers\url_helper.php 564
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 374
ERROR - 2017-05-31 18:55:14 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 18:55:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\MJF\web\admin\system\core\Exceptions.php:271) C:\MJF\web\admin\system\helpers\url_helper.php 564
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 376
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 376
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 376
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 375
ERROR - 2017-05-31 19:05:38 --> Severity: Notice --> Undefined offset: 0 C:\MJF\web\admin\application\controllers\Doc.php 376
ERROR - 2017-05-31 19:05:38 --> 404 Page Not Found: Doc/bg1.jpg
ERROR - 2017-05-31 19:05:38 --> 404 Page Not Found: Doc/bg5.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bg2.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bgb.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bgc.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bgd.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bge.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bg6.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bg7.jpg
ERROR - 2017-05-31 19:05:39 --> 404 Page Not Found: Doc/bg9.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg1.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg2.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bgb.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg6.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bgc.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg5.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bgd.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bge.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg9.jpg
ERROR - 2017-05-31 19:18:11 --> 404 Page Not Found: Doc/bg7.jpg
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\006): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\007): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\008): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\009): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\010): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\011): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\012): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\013): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\014): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\015): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\016): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\017): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\018): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:10 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\019): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\033): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\034): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\035): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\036): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\037): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\038): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\039): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\040): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\041): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\042): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\043): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\044): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\045): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\046): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\047): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\048): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\049): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\050): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:38:30 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409655\051): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\034): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\035): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\036): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\037): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\038): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\039): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\040): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\041): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\042): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\043): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\044): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\045): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\046): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\047): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\048): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\049): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\050): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\051): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\052): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\053): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\054): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\055): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\056): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\057): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\058): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\059): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\060): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\061): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\062): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\063): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\064): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\065): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\066): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\067): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\068): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\069): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\070): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\071): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\072): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\073): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\074): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\075): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\076): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\077): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\078): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\079): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\080): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\081): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\082): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\083): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:01 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409845\084): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\008): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\009): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\010): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\011): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\012): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\013): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\014): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\015): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\016): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\017): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\018): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\019): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\020): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\021): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\022): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\023): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\024): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\025): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\026): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\027): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\028): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\029): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\030): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\031): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\032): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\033): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\034): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\035): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\036): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\037): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\038): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\039): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\040): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\041): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\042): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\043): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\044): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\045): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\046): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\047): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\048): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\049): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\050): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\051): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\052): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\053): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\054): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\055): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\056): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\057): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\058): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\059): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\060): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\061): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\062): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\063): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\064): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\065): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\066): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\067): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\068): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\069): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\070): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\071): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\072): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\073): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\074): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\075): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\076): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\077): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\078): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\079): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\080): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\081): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\082): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\083): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\084): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\085): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\086): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\087): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\088): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\089): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\090): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:39:25 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491410076\091): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 625
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\006): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\007): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\008): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\009): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\010): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\011): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\012): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\013): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\014): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\015): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\016): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\017): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\018): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:51:06 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\019): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 627
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\006): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\007): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\008): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\009): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\010): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\011): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\012): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\013): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\014): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\015): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\016): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\017): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\018): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
ERROR - 2017-05-31 19:56:09 --> Severity: Warning --> file_get_contents(C:\MJF\web\doc\view\1491409585\019): failed to open stream: No such file or directory C:\MJF\web\admin\application\controllers\Doc.php 626
