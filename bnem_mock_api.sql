
CREATE TABLE `accountbalance` (
  `idAccountBalance` int(11) NOT NULL,
  `accountNumber` int(11) NOT NULL,
  `branchCode` varchar(45) NOT NULL,
  `accountCategoryCode` varchar(45) DEFAULT NULL,
  `accountTitleName` varchar(45) DEFAULT NULL,
  `additionalInformation` varchar(45) DEFAULT NULL,
  `currencyCode` varchar(45) DEFAULT NULL,
  `currentBalanceAmount` double DEFAULT NULL,
  `visibilityFlag` bit(1) DEFAULT NULL,
  `lastActivityDate` date DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `idTransaction` int(11) NOT NULL,
  `authorizationCode` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` datetime DEFAULT NULL,
  `operatorId` varchar(255) DEFAULT NULL,
  `retrievedBy` varchar(255) DEFAULT NULL,
  `tableSerialNumber` varchar(255) DEFAULT NULL,
  `transactionAmount` int(11) DEFAULT NULL,
  `transactionDate` datetime DEFAULT NULL,
  `transactionDescription` varchar(255) DEFAULT NULL,
  `transactionReferenceDetail` bit(1) DEFAULT NULL,
  `transactionResponseReasonCode` varchar(255) DEFAULT NULL,
  `transactionShortDescription` varchar(255) DEFAULT NULL,
  `transactionStatus` varchar(255) DEFAULT NULL,
  `transactionStatusCode` varchar(255) DEFAULT NULL,
  `transactionTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `accountbalance`
--

INSERT INTO `accountbalance` (`idAccountBalance`, `accountNumber`, `branchCode`, `accountCategoryCode`, `accountTitleName`, `additionalInformation`, `currencyCode`, `currentBalanceAmount`, `visibilityFlag`, `lastActivityDate`, `type`, `customerId`, `idTransaction`, `authorizationCode`, `lastUpdatedBy`, `operatorId`, `retrievedBy`, `tableSerialNumber`, `transactionAmount`, `transactionDate`, `transactionDescription`, `transactionReferenceDetail`, `transactionResponseReasonCode`, `transactionShortDescription`, `transactionStatus`, `transactionStatusCode`, `transactionTime`) VALUES
(3, -1638875469, '100', '1', 'Pruebas', 'Pruebas ', 'MXN', 128736128746, b'1', NULL, 1, 13051511, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banamexfund`
--

CREATE TABLE `banamexfund` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` int(11) DEFAULT NULL,
  `folioNumber` double DEFAULT NULL,
  `investmentDate` datetime DEFAULT NULL,
  `latestFundPrice` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checking`
--

CREATE TABLE `checking` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `clabeNumber` varchar(255) DEFAULT NULL,
  `depositDueAmount` double DEFAULT NULL,
  `pendingDepositAmount` double DEFAULT NULL,
  `transactionCount` int(11) DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditbalance`
--

CREATE TABLE `creditbalance` (
  `idCredit` int(11) NOT NULL,
  `totalDepositAmount` double DEFAULT NULL,
  `totalInterestAmount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditcard`
--

CREATE TABLE `creditcard` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `billingcycleDate` datetime DEFAULT NULL,
  `creditAvailableAmount` double DEFAULT NULL,
  `creditCardcol` double DEFAULT NULL,
  `creditLimitAmount` double DEFAULT NULL,
  `lastActivityDescription` varchar(255) DEFAULT NULL,
  `lastPaymentDate` datetime DEFAULT NULL,
  `minimumPaymentDueAmount` double DEFAULT NULL,
  `statementBalanceAmount` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `idLegalR` int(11) NOT NULL,
  `challengeCode` varchar(255) DEFAULT NULL,
  `contingency` varchar(255) DEFAULT NULL,
  `dataCenterLocal` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `lastChannelId` varchar(255) DEFAULT NULL,
  `lastLoginDate` datetime DEFAULT NULL,
  `lastLoginTime` time DEFAULT NULL,
  `lastUpdateDate` date DEFAULT NULL,
  `legalRepresentativeId` int(11) DEFAULT NULL,
  `loginCounter` varchar(255) DEFAULT NULL,
  `moreInfo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `passwordExpiryDate` datetime DEFAULT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `stationName` varchar(255) DEFAULT NULL,
  `virtualAccoutExistFlag` varchar(255) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`idLegalR`, `challengeCode`, `contingency`, `dataCenterLocal`, `fullName`, `lastChannelId`, `lastLoginDate`, `lastLoginTime`, `lastUpdateDate`, `legalRepresentativeId`, `loginCounter`, `moreInfo`, `password`, `passwordExpiryDate`, `sid`, `stationName`, `virtualAccoutExistFlag`, `customerId`) VALUES
(1, '123456789', 'Prueba ', 'Prueba ', 'Hector Salinas', '1', NULL, NULL, '2019-04-02', 21, '0', 'Pruebas', 'A1B2C3', NULL, NULL, 'SATELITE', NULL, 13051511);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customerbusiness`
--

CREATE TABLE `customerbusiness` (
  `customerId` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estatus` bit(1) DEFAULT NULL,
  `razonSocial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customerbusiness`
--

INSERT INTO `customerbusiness` (`customerId`, `descripcion`, `estatus`, `razonSocial`) VALUES
(1974230, 'Prueba 1', b'1', 'Grupo Santander'),
(13051511, 'Cliente Pruebas', b'1', 'Prueba 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customerproduct`
--

CREATE TABLE `customerproduct` (
  `customerId` int(11) DEFAULT NULL,
  `productTypeCode` int(10) DEFAULT NULL,
  `productSubtypeCode` int(10) DEFAULT NULL,
  `totalrelatedAccountsCount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customerservice`
--

CREATE TABLE `customerservice` (
  `customerId` int(11) DEFAULT NULL,
  `bankServiceId` int(11) DEFAULT NULL,
  `bankServiceType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debitcard`
--

CREATE TABLE `debitcard` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `billingCycleDate` datetime DEFAULT NULL,
  `depositDueAmount` double DEFAULT NULL,
  `lastActivityDescription` varchar(255) DEFAULT NULL,
  `lastPaymentDate` datetime DEFAULT NULL,
  `totalPreviousBalanceAmount` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horizonfunds`
--

CREATE TABLE `horizonfunds` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountStatus` varchar(255) DEFAULT NULL,
  `currentValueAmount` double DEFAULT NULL,
  `pendingOrders` int(11) DEFAULT NULL,
  `soldShareValue` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `legalrepresentative`
--

CREATE TABLE `legalrepresentative` (
  `legalRepresentativeId` int(11) DEFAULT NULL,
  `legalRepresentativeName` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `master`
--

CREATE TABLE `master` (
  `idAccount` int(11) NOT NULL,
  `accountType` varchar(45) DEFAULT NULL,
  `accountLabel` varchar(45) DEFAULT NULL,
  `totalPendingAuthorizationAmount` double DEFAULT NULL,
  `accruedInterestAmount` double DEFAULT NULL,
  `lastActivityDate` date DEFAULT NULL,
  `todayDepositAmount` double DEFAULT NULL,
  `todayWithwalAmount` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL,
  `idOverDraftLine` int(11) DEFAULT NULL,
  `idCreditBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `overdraftline`
--

CREATE TABLE `overdraftline` (
  `idOver` int(11) NOT NULL,
  `currentBalanceAmount` double DEFAULT NULL,
  `overDraftAmount` double DEFAULT NULL,
  `overDraftUsedAmount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pyme`
--

CREATE TABLE `pyme` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `billingCycleDate` datetime DEFAULT NULL,
  `creditAvailableAmount` double DEFAULT NULL,
  `creditLimitAmount` double DEFAULT NULL,
  `depositDueAmount` double DEFAULT NULL,
  `lastActivityDescription` varchar(255) DEFAULT NULL,
  `lastPaymentDate` datetime DEFAULT NULL,
  `minimumPaymentdueAmount` double DEFAULT NULL,
  `statementBalanceAmount` varchar(255) DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminvestment`
--

CREATE TABLE `terminvestment` (
  `idAccount` int(11) NOT NULL,
  `InterestRate` double DEFAULT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountStatus` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `beginningBalanceAmount` double DEFAULT NULL,
  `custumerName` varchar(255) DEFAULT NULL,
  `depositStartDate` datetime DEFAULT NULL,
  `folioNumber` int(11) DEFAULT NULL,
  `instrumentType` varchar(255) DEFAULT NULL,
  `interestAmount` double DEFAULT NULL,
  `investmentStatusReason` varchar(255) DEFAULT NULL,
  `maturityAmount` double DEFAULT NULL,
  `maturityDate` datetime DEFAULT NULL,
  `maturityInstruccionType` varchar(255) DEFAULT NULL,
  `refundAccountBranchCode` varchar(255) DEFAULT NULL,
  `refundAccountNumber` varchar(255) DEFAULT NULL,
  `refundAccountType` varchar(255) DEFAULT NULL,
  `tenureTerm` varchar(255) DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `type` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`type`, `label`, `name`) VALUES
(1, 'CHECKING', 'CHECKING');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viewinvestment`
--

CREATE TABLE `viewinvestment` (
  `idAccount` int(11) NOT NULL,
  `accountLabel` varchar(255) DEFAULT NULL,
  `accountStatus` varchar(255) DEFAULT NULL,
  `pendingOrders` double DEFAULT NULL,
  `idAccountBalance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accountbalance`
--
ALTER TABLE `accountbalance`
  ADD PRIMARY KEY (`idAccountBalance`),
  ADD KEY `FKk2jexqv7f81vqfnv9nqb46cg6` (`customerId`),
  ADD KEY `FKphn1crj7m5rm8w2hneknntw92` (`type`);

--
-- Indices de la tabla `banamexfund`
--
ALTER TABLE `banamexfund`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKnehevgk70oito2aqq3l8ucnpt` (`idAccountBalance`);

--
-- Indices de la tabla `checking`
--
ALTER TABLE `checking`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKccbxhscsy59o6s37fr7pb4a2s` (`idAccountBalance`);

--
-- Indices de la tabla `creditbalance`
--
ALTER TABLE `creditbalance`
  ADD PRIMARY KEY (`idCredit`);

--
-- Indices de la tabla `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKk9m95bgdyfv2ym8hyb3eftiye` (`idAccountBalance`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idLegalR`),
  ADD KEY `FKmojs0mjqupdbdi8i9cwhjtdcr` (`customerId`);

--
-- Indices de la tabla `customerbusiness`
--
ALTER TABLE `customerbusiness`
  ADD PRIMARY KEY (`customerId`);

--
-- Indices de la tabla `customerproduct`
--
ALTER TABLE `customerproduct`
  ADD KEY `customerId` (`customerId`);

--
-- Indices de la tabla `customerservice`
--
ALTER TABLE `customerservice`
  ADD KEY `customerId` (`customerId`);

--
-- Indices de la tabla `debitcard`
--
ALTER TABLE `debitcard`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKo0y4jk3yj1b65taq88a46b31p` (`idAccountBalance`);

--
-- Indices de la tabla `horizonfunds`
--
ALTER TABLE `horizonfunds`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKdy1q0c390jwhtpba7lcvvq33j` (`idAccountBalance`);

--
-- Indices de la tabla `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `fk_account_balance_idx` (`idAccountBalance`),
  ADD KEY `FK4sp6ktssf1i9ebqfd04wmx52b` (`idCreditBalance`),
  ADD KEY `FK8tmrsaaqdhj4ahi740j26k21r` (`idOverDraftLine`);

--
-- Indices de la tabla `overdraftline`
--
ALTER TABLE `overdraftline`
  ADD PRIMARY KEY (`idOver`);

--
-- Indices de la tabla `pyme`
--
ALTER TABLE `pyme`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKawwboxfx7co7y0ncx7c1sgh6o` (`idAccountBalance`);

--
-- Indices de la tabla `terminvestment`
--
ALTER TABLE `terminvestment`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKspdrudwm59xk4rb4nervwvap0` (`idAccountBalance`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type`);

--
-- Indices de la tabla `viewinvestment`
--
ALTER TABLE `viewinvestment`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `FKak7u2x3moey8vhj956k18jpmb` (`idAccountBalance`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accountbalance`
--
ALTER TABLE `accountbalance`
  MODIFY `idAccountBalance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `banamexfund`
--
ALTER TABLE `banamexfund`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `checking`
--
ALTER TABLE `checking`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditbalance`
--
ALTER TABLE `creditbalance`
  MODIFY `idCredit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `idLegalR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `debitcard`
--
ALTER TABLE `debitcard`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horizonfunds`
--
ALTER TABLE `horizonfunds`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `master`
--
ALTER TABLE `master`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `overdraftline`
--
ALTER TABLE `overdraftline`
  MODIFY `idOver` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pyme`
--
ALTER TABLE `pyme`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terminvestment`
--
ALTER TABLE `terminvestment`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viewinvestment`
--
ALTER TABLE `viewinvestment`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accountbalance`
--
ALTER TABLE `accountbalance`
  ADD CONSTRAINT `FKk2jexqv7f81vqfnv9nqb46cg6` FOREIGN KEY (`customerId`) REFERENCES `customerbusiness` (`customerId`),
  ADD CONSTRAINT `FKphn1crj7m5rm8w2hneknntw92` FOREIGN KEY (`type`) REFERENCES `type` (`type`);

--
-- Filtros para la tabla `banamexfund`
--
ALTER TABLE `banamexfund`
  ADD CONSTRAINT `FKnehevgk70oito2aqq3l8ucnpt` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `checking`
--
ALTER TABLE `checking`
  ADD CONSTRAINT `FKccbxhscsy59o6s37fr7pb4a2s` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `FKk9m95bgdyfv2ym8hyb3eftiye` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FKmojs0mjqupdbdi8i9cwhjtdcr` FOREIGN KEY (`customerId`) REFERENCES `customerbusiness` (`customerId`);

--
-- Filtros para la tabla `customerproduct`
--
ALTER TABLE `customerproduct`
  ADD CONSTRAINT `customerId_products` FOREIGN KEY (`customerId`) REFERENCES `customerbusiness` (`customerId`);

--
-- Filtros para la tabla `customerservice`
--
ALTER TABLE `customerservice`
  ADD CONSTRAINT `customerId_service` FOREIGN KEY (`customerId`) REFERENCES `customerbusiness` (`customerId`);

--
-- Filtros para la tabla `debitcard`
--
ALTER TABLE `debitcard`
  ADD CONSTRAINT `FKo0y4jk3yj1b65taq88a46b31p` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `horizonfunds`
--
ALTER TABLE `horizonfunds`
  ADD CONSTRAINT `FKdy1q0c390jwhtpba7lcvvq33j` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `master`
--
ALTER TABLE `master`
  ADD CONSTRAINT `FK4sp6ktssf1i9ebqfd04wmx52b` FOREIGN KEY (`idCreditBalance`) REFERENCES `creditbalance` (`idCredit`),
  ADD CONSTRAINT `FK8tmrsaaqdhj4ahi740j26k21r` FOREIGN KEY (`idOverDraftLine`) REFERENCES `overdraftline` (`idOver`),
  ADD CONSTRAINT `fk_account_balance_a` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pyme`
--
ALTER TABLE `pyme`
  ADD CONSTRAINT `FKawwboxfx7co7y0ncx7c1sgh6o` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `terminvestment`
--
ALTER TABLE `terminvestment`
  ADD CONSTRAINT `FKspdrudwm59xk4rb4nervwvap0` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);

--
-- Filtros para la tabla `viewinvestment`
--
ALTER TABLE `viewinvestment`
  ADD CONSTRAINT `FKak7u2x3moey8vhj956k18jpmb` FOREIGN KEY (`idAccountBalance`) REFERENCES `accountbalance` (`idAccountBalance`);
