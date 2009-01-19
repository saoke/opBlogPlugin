<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * MemberConfigBlogUrlForm form.
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Masato Nagasawa <nagasawa@tejimaya.net>
 */
class MemberConfigBlogUrlForm extends MemberConfigForm
{
  protected $category = 'blogUrl';

  public function setMemberConfigWidget($name)
  {
    $result = parent::setMemberConfigWidget($name);

    if ($name === 'blog_url')
    {
      $this->mergePostValidator(new sfValidatorCallback(array(
        'callback'  => array($this, 'validate'),
      )));
    }

    return $result;
  }

  public function validate($validator, $value)
  {
    $root = BlogPeer::getXmlByUrl($value['blog_url']);
    if (!BlogPeer::getFeedType($root))
    {
      throw new sfValidatorError($validator, 'URL is invalid');
    }
    return $value;
  }
}
