<?php
/**
 * 0 为成功，不同模块指定一个不同的开头数字，4 位数。1 开头的是全局错误，比如 1001 未登录，1002 无权限等。其他模块比如 3001，3002 以此递增。
 * User: liseen
 * Date: 2019-10-15
 * Time: 17:02
 */

return [
    0 => 'Success',
    // csrfmiss
    1001 => 'Login session timed out',
    // tag
    2001 => 'Tag id can not be null',
    2002 => 'Failed to find the tag with the corresponding ID',

    // 文章
    3001 => 'Image upload failed',

    // 评论
    4001 => 'Create comment failed',
];
