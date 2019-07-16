<?php

// include "bootstrap.php";

$options = array
(
    'hostname' => 'solr7-staging-external-322384220.us-east-1.elb.amazonaws.com',
    'path'     => '/solr/staging-update',
    'port'     => '8983',
    'wt'       => 'xslt'
);

$client = new SolrClient($options);

$query = new SolrQuery('*:*');

// $query->setQuery('lucene');

$query->setStart(0);

$query->setRows(0);

$query->addField('real_title')->addField('object_id');

$query->setFacet(true);

$query->addFacetField('person_facet')->setFacetMinCount(1)->setFacetMinCount(1, 'person_facet')->setFacetLimit(10000,'person_facet')->setFacetSort(SolrQuery::FACET_SORT_INDEX, 'person_facet');

$query->set('tr','browsemenu.xsl');

$client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, 'selectterms');
$query_response = $client->query($query);

$query_response->setParseMode(SolrQueryResponse::PARSE_SOLR_DOC);


$response = $query_response->getResponse();

 print_r($query_response->getRawRequest());

print_r($response);


?>
