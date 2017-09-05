<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-03 01:19:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 01:46:37 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 02:01:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 02:01:22 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 12:47:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 13:43:46 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 13:43:52 --> 404 Page Not Found: Faviconico/index
ERROR - 2017-09-03 13:48:51 --> Severity: Notice --> Undefined property: Doc::$cii_pagination C:\MJF\web\admin\application\controllers\Doc.php 103
ERROR - 2017-09-03 13:48:51 --> Severity: Error --> Call to a member function initialize() on null C:\MJF\web\admin\application\controllers\Doc.php 103
ERROR - 2017-09-03 13:50:37 --> Severity: Notice --> Undefined property: Doc::$cii_pagination C:\MJF\web\admin\application\controllers\Doc.php 103
ERROR - 2017-09-03 13:50:37 --> Severity: Error --> Call to a member function initialize() on null C:\MJF\web\admin\application\controllers\Doc.php 103
ERROR - 2017-09-03 13:51:45 --> Severity: Notice --> Undefined property: CI_Loader::$cii_pagination C:\MJF\web\admin\application\views\doc_list_view.php 30
ERROR - 2017-09-03 13:51:45 --> Severity: Error --> Call to a member function create_links() on null C:\MJF\web\admin\application\views\doc_list_view.php 30
ERROR - 2017-09-03 13:56:50 --> Severity: Notice --> Undefined property: Doc::$cii_input C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 13:56:50 --> Severity: Error --> Call to a member function post() on null C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 13:56:51 --> Severity: Notice --> Undefined property: Doc::$cii_input C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 13:56:51 --> Severity: Error --> Call to a member function post() on null C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 13:56:51 --> Severity: Notice --> Undefined property: Doc::$cii_input C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 13:56:51 --> Severity: Error --> Call to a member function post() on null C:\MJF\web\admin\application\controllers\Doc.php 757
ERROR - 2017-09-03 14:54:43 --> Severity: Warning --> Missing argument 1 for Doc::detail() C:\MJF\web\admin\ci\application\controllers\Doc.php 132
ERROR - 2017-09-03 14:54:43 --> Severity: Notice --> Undefined variable: doc_id C:\MJF\web\admin\ci\application\controllers\Doc.php 134
ERROR - 2017-09-03 14:54:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LIMIT 1' at line 15 - Invalid query: SELECT 
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
