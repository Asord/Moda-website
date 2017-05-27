<?php
/**
 * @Entity @Table(name="article")
 **/
class Article
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $title;
    /** @Column(type="text") **/
    protected $content;
    /** @Column(type="string") **/
    protected $credit_author;
    /** @Column(type="string") **/
    protected $credit_contrib;
    /** @Column(type="string") **/
    protected $image_link;
    /** @Column(type="string") **/
    protected $tags;

    public function getId()       { return $this->id; }
	
    public function getTitle()    { return $this->title; }
    public function setTitle($name)      { $this->title = $name; }
	
	public function getImageLink(){ return $this->image_link; }
    public function setImageLink($link)  { $this->image_link = $link; }
	
	public function getContent()  { return $this->content; }
    public function setContent($content) { $this->content = $content; }
	
	public function getAuthor()   { return $this->credit_author; }
    public function setAuthor($author)   { $this->credit_author = $author; }
	
	public function getContrib()  { return $this->credit_contrib; }
    public function setContrib($contrib) { $this->credit_contrib = $contrib; }
	
	public function getTags()     { return $this->tags; }
    public function setTags($tags)       { $this->tags = $tags; }
}