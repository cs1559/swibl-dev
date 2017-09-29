<?php
/**
 * URI constructor
 *
 * @category  Tools_And_Utilities
 * @package   Uri
 * @author    Anton Lindqvist <anton@qvister.se>
 * @copyright 2011 Anton Lindqvist <anton@qvister.se>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/mptre/php-uri
 */
class Uri
{

    /**
     * URI protocol
     *
     * @var string
     *
     * @access public
     */
    public $protocol;

    /**
     * URI username
     *
     * @var string
     *
     * @access public
     */
    public $username;

    /**
     * URI password
     *
     * @var string
     *
     * @access public
     */
    public $password;

    /**
     * URI hostname
     *
     * @var string
     *
     * @access public
     */
    public $host;

    /**
     * URI path
     *
     * @var array
     *
     * @access public
     */
    public $path;

    /**
     * URI parameters
     *
     * @var array
     *
     * @access public
     */
    public $parameters;

    /**
     * URI hash
     *
     * @var array
     *
     * @access public
     */
    public $hash;

    /**
     * Default options
     *
     * @var array
     *
     * @access private
     * @static
     */
    private static $_defaultOptions = array(
        'encode' => false,
        'hash' => null,
        'parameters' => null,
        'password' => null,
        'port' => 80,
        'protocol' => 'http',
        'separator' => '&',
        'ssl' => false,
        'username' => null
    );

    /**
     * Options
     *
     * @var array
     *
     * @access private
     */
    private $_options;

    /**
     * Class constructor
     *
     * @param string       $host    Hostname
     * @param string|array $path    Optional path to request as a string or array
     * @param array        $options Optional options
     *
     * @return void
     *
     * @access public
     */
    public function __construct($host, $path = null, $options = array())
    {
        $this->host = $host;
        $this->path = $path;
        $this->_options = array_merge(self::$_defaultOptions, $options);

        $this->initialize($host, $path);
    }

    /**
     * Construct public variables
     *
     * @return void
     *
     * @access public
     */
    public function initialize()
    {
        $this->protocol = $this->_options['protocol'];
        $this->protocol .= ($this->_options['ssl']) ? 's' : '';

        $this->username = $this->_options['username'];
        $this->password = $this->_options['password'];

        $this->host = $this->host;
        $this->host .= ($this->_options['port'] != 80)
            ? ':' . $this->_options['port']
            : '';

        $this->path = (is_array($this->path)) ? $this->path : array($this->path);
        $this->path = '/' . implode('/', array_filter($this->path));

        $this->parameters = $this->_options['parameters'];

        $this->hash = $this->_options['hash'];
    }

    /**
     * Magic method used for constructing the URI
     *
     * @return string $uri
     *
     * @access public
     */
    public function __toString()
    {
        $uri = $this->protocol;
        $uri .= '://';
        $uri .= ($this->username) ?: '';
        $uri .= ($this->username && $this->password) ? ':' . $this->password : '';
        $uri .= ($this->username || $this->password) ? '@' : '';
        $uri .= $this->host;
        $uri .= $this->path;
        $uri .= ($this->parameters)
            ? '?' . http_build_query(
                $this->parameters,
                '',
                $this->_options['separator']
            )
            : '';
        $uri .= ($this->hash)
            ? '#' . http_build_query($this->hash, '', $this->_options['separator'])
            : '';
        $uri = ($this->_options['encode']) ? urlencode($uri) : $uri;

        return $uri;
    }

}
