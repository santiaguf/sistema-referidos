-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(7) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(20) NOT NULL,
  `apellido_cliente` varchar(20) DEFAULT NULL,
  `telefono_cliente` varchar(16) DEFAULT NULL,
  `email_cliente` varchar(40) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `tipo_servicio` varchar(20) NOT NULL,
  `id_vendedor` int(4) NOT NULL,
  `subsource` varchar(40) DEFAULT 'none',
  `creado_por` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `telefono_cliente`, `email_cliente`, `fecha_registro`, `tipo_servicio`, `id_vendedor`, `subsource`, `creado_por`) VALUES
(1, 'Frank', 'Martinez', '234567890', 'd@m.com', '2014-03-24', 'ReparaciÃ³n crÃ©dito', 25, 'none', 5),
(2, 'alvaro', 'uribe velez', '(111) 222 3344', 'alvaro@velez.co', '2014-03-29', 'Compra de casa', 22, 'estiven jaramillo', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(10) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `perfil` varchar(14) NOT NULL,
  `tipoperfil` int(2) NOT NULL,
  `nombre_completo` varchar(40) DEFAULT NULL,
  `movil` varchar(20) DEFAULT NULL,
  `creado_por` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nick` (`nick`,`pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `fecha`, `nick`, `pass`, `mail`, `ip`, `perfil`, `tipoperfil`, `nombre_completo`, `movil`, `creado_por`) VALUES
(1, '2014-03-10', 'juanks10', 'f35d242dd4f13a4ff4be859fa867a0cd', 'juanks10@hotmail.com', '186.86.26.171', 'administrador', 1, 'Juan Carlos', '3163659199', NULL),
(2, '2014-03-25', 'santiago', '40e4f3176c7e9bbbc95cd4505d1927ae', 'exactlimon@gmail.com', '142.4.201.183', 'administrador', 1, 'santiago bernal', '111', NULL);