<?php

/*
 * Generated from MySQLParser.g4 by ANTLR 4.13.2
 */

namespace Bleksak\MagoPdoExtension\Sql\MySql;
use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@see MySQLParser}.
 */
interface MySQLParserListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queries()}.
	 * @param $context The parse tree.
	 */
	public function enterQueries(Context\QueriesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queries()}.
	 * @param $context The parse tree.
	 */
	public function exitQueries(Context\QueriesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::query()}.
	 * @param $context The parse tree.
	 */
	public function enterQuery(Context\QueryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::query()}.
	 * @param $context The parse tree.
	 */
	public function exitQuery(Context\QueryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::simpleStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleStatement(Context\SimpleStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::simpleStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleStatement(Context\SimpleStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterStatement(Context\AlterStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterStatement(Context\AlterStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterDatabase()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterDatabase(Context\AlterDatabaseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterDatabase()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterDatabase(Context\AlterDatabaseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterDatabaseOption()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterDatabaseOption(Context\AlterDatabaseOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterDatabaseOption()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterDatabaseOption(Context\AlterDatabaseOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterEvent()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterEvent(Context\AlterEventContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterEvent()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterEvent(Context\AlterEventContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterLogfileGroup(Context\AlterLogfileGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterLogfileGroup(Context\AlterLogfileGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterLogfileGroupOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterLogfileGroupOptions(Context\AlterLogfileGroupOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterLogfileGroupOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterLogfileGroupOptions(Context\AlterLogfileGroupOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterLogfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterLogfileGroupOption(Context\AlterLogfileGroupOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterLogfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterLogfileGroupOption(Context\AlterLogfileGroupOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterServer()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterServer(Context\AlterServerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterServer()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterServer(Context\AlterServerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterTable()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterTable(Context\AlterTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterTable()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterTable(Context\AlterTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterTableActions()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterTableActions(Context\AlterTableActionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterTableActions()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterTableActions(Context\AlterTableActionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterCommandList()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterCommandList(Context\AlterCommandListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterCommandList()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterCommandList(Context\AlterCommandListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterCommandsModifierList()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterCommandsModifierList(Context\AlterCommandsModifierListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterCommandsModifierList()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterCommandsModifierList(Context\AlterCommandsModifierListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::standaloneAlterCommands()}.
	 * @param $context The parse tree.
	 */
	public function enterStandaloneAlterCommands(Context\StandaloneAlterCommandsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::standaloneAlterCommands()}.
	 * @param $context The parse tree.
	 */
	public function exitStandaloneAlterCommands(Context\StandaloneAlterCommandsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterPartition()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterPartition(Context\AlterPartitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterPartition()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterPartition(Context\AlterPartitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterList()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterList(Context\AlterListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterList()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterList(Context\AlterListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterCommandsModifier()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterCommandsModifier(Context\AlterCommandsModifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterCommandsModifier()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterCommandsModifier(Context\AlterCommandsModifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterListItem()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterListItem(Context\AlterListItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterListItem()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterListItem(Context\AlterListItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::place()}.
	 * @param $context The parse tree.
	 */
	public function enterPlace(Context\PlaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::place()}.
	 * @param $context The parse tree.
	 */
	public function exitPlace(Context\PlaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::restrict()}.
	 * @param $context The parse tree.
	 */
	public function enterRestrict(Context\RestrictContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::restrict()}.
	 * @param $context The parse tree.
	 */
	public function exitRestrict(Context\RestrictContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterOrderList()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterOrderList(Context\AlterOrderListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterOrderList()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterOrderList(Context\AlterOrderListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterAlgorithmOption()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterAlgorithmOption(Context\AlterAlgorithmOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterAlgorithmOption()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterAlgorithmOption(Context\AlterAlgorithmOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterLockOption()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterLockOption(Context\AlterLockOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterLockOption()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterLockOption(Context\AlterLockOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexLockAndAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexLockAndAlgorithm(Context\IndexLockAndAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexLockAndAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexLockAndAlgorithm(Context\IndexLockAndAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::withValidation()}.
	 * @param $context The parse tree.
	 */
	public function enterWithValidation(Context\WithValidationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::withValidation()}.
	 * @param $context The parse tree.
	 */
	public function exitWithValidation(Context\WithValidationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::removePartitioning()}.
	 * @param $context The parse tree.
	 */
	public function enterRemovePartitioning(Context\RemovePartitioningContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::removePartitioning()}.
	 * @param $context The parse tree.
	 */
	public function exitRemovePartitioning(Context\RemovePartitioningContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::allOrPartitionNameList()}.
	 * @param $context The parse tree.
	 */
	public function enterAllOrPartitionNameList(Context\AllOrPartitionNameListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::allOrPartitionNameList()}.
	 * @param $context The parse tree.
	 */
	public function exitAllOrPartitionNameList(Context\AllOrPartitionNameListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterTablespace()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterTablespace(Context\AlterTablespaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterTablespace()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterTablespace(Context\AlterTablespaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterUndoTablespace(Context\AlterUndoTablespaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterUndoTablespace(Context\AlterUndoTablespaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::undoTableSpaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterUndoTableSpaceOptions(Context\UndoTableSpaceOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::undoTableSpaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitUndoTableSpaceOptions(Context\UndoTableSpaceOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::undoTableSpaceOption()}.
	 * @param $context The parse tree.
	 */
	public function enterUndoTableSpaceOption(Context\UndoTableSpaceOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::undoTableSpaceOption()}.
	 * @param $context The parse tree.
	 */
	public function exitUndoTableSpaceOption(Context\UndoTableSpaceOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterTablespaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterTablespaceOptions(Context\AlterTablespaceOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterTablespaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterTablespaceOptions(Context\AlterTablespaceOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterTablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterTablespaceOption(Context\AlterTablespaceOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterTablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterTablespaceOption(Context\AlterTablespaceOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeTablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeTablespaceOption(Context\ChangeTablespaceOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeTablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeTablespaceOption(Context\ChangeTablespaceOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterView()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterView(Context\AlterViewContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterView()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterView(Context\AlterViewContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewTail()}.
	 * @param $context The parse tree.
	 */
	public function enterViewTail(Context\ViewTailContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewTail()}.
	 * @param $context The parse tree.
	 */
	public function exitViewTail(Context\ViewTailContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewQueryBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterViewQueryBlock(Context\ViewQueryBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewQueryBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitViewQueryBlock(Context\ViewQueryBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewCheckOption()}.
	 * @param $context The parse tree.
	 */
	public function enterViewCheckOption(Context\ViewCheckOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewCheckOption()}.
	 * @param $context The parse tree.
	 */
	public function exitViewCheckOption(Context\ViewCheckOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterInstanceStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterInstanceStatement(Context\AlterInstanceStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterInstanceStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterInstanceStatement(Context\AlterInstanceStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateStatement(Context\CreateStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateStatement(Context\CreateStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createDatabase()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateDatabase(Context\CreateDatabaseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createDatabase()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateDatabase(Context\CreateDatabaseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createDatabaseOption()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateDatabaseOption(Context\CreateDatabaseOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createDatabaseOption()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateDatabaseOption(Context\CreateDatabaseOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTable()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTable(Context\CreateTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTable()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTable(Context\CreateTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableElementList()}.
	 * @param $context The parse tree.
	 */
	public function enterTableElementList(Context\TableElementListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableElementList()}.
	 * @param $context The parse tree.
	 */
	public function exitTableElementList(Context\TableElementListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableElement()}.
	 * @param $context The parse tree.
	 */
	public function enterTableElement(Context\TableElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableElement()}.
	 * @param $context The parse tree.
	 */
	public function exitTableElement(Context\TableElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::duplicateAsQe()}.
	 * @param $context The parse tree.
	 */
	public function enterDuplicateAsQe(Context\DuplicateAsQeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::duplicateAsQe()}.
	 * @param $context The parse tree.
	 */
	public function exitDuplicateAsQe(Context\DuplicateAsQeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::asCreateQueryExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterAsCreateQueryExpression(Context\AsCreateQueryExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::asCreateQueryExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitAsCreateQueryExpression(Context\AsCreateQueryExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryExpressionOrParens()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryExpressionOrParens(Context\QueryExpressionOrParensContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryExpressionOrParens()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryExpressionOrParens(Context\QueryExpressionOrParensContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryExpressionWithOptLockingClauses()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryExpressionWithOptLockingClauses(Context\QueryExpressionWithOptLockingClausesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryExpressionWithOptLockingClauses()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryExpressionWithOptLockingClauses(Context\QueryExpressionWithOptLockingClausesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createRoutine()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateRoutine(Context\CreateRoutineContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createRoutine()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateRoutine(Context\CreateRoutineContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createProcedure()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateProcedure(Context\CreateProcedureContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createProcedure()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateProcedure(Context\CreateProcedureContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::routineString()}.
	 * @param $context The parse tree.
	 */
	public function enterRoutineString(Context\RoutineStringContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::routineString()}.
	 * @param $context The parse tree.
	 */
	public function exitRoutineString(Context\RoutineStringContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::storedRoutineBody()}.
	 * @param $context The parse tree.
	 */
	public function enterStoredRoutineBody(Context\StoredRoutineBodyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::storedRoutineBody()}.
	 * @param $context The parse tree.
	 */
	public function exitStoredRoutineBody(Context\StoredRoutineBodyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateFunction(Context\CreateFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateFunction(Context\CreateFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUdf()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUdf(Context\CreateUdfContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUdf()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUdf(Context\CreateUdfContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::routineCreateOption()}.
	 * @param $context The parse tree.
	 */
	public function enterRoutineCreateOption(Context\RoutineCreateOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::routineCreateOption()}.
	 * @param $context The parse tree.
	 */
	public function exitRoutineCreateOption(Context\RoutineCreateOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::routineAlterOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterRoutineAlterOptions(Context\RoutineAlterOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::routineAlterOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitRoutineAlterOptions(Context\RoutineAlterOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::routineOption()}.
	 * @param $context The parse tree.
	 */
	public function enterRoutineOption(Context\RoutineOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::routineOption()}.
	 * @param $context The parse tree.
	 */
	public function exitRoutineOption(Context\RoutineOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createIndex()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateIndex(Context\CreateIndexContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createIndex()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateIndex(Context\CreateIndexContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexNameAndType()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexNameAndType(Context\IndexNameAndTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexNameAndType()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexNameAndType(Context\IndexNameAndTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createIndexTarget()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateIndexTarget(Context\CreateIndexTargetContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createIndexTarget()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateIndexTarget(Context\CreateIndexTargetContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateLogfileGroup(Context\CreateLogfileGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateLogfileGroup(Context\CreateLogfileGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::logfileGroupOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterLogfileGroupOptions(Context\LogfileGroupOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::logfileGroupOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitLogfileGroupOptions(Context\LogfileGroupOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::logfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function enterLogfileGroupOption(Context\LogfileGroupOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::logfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function exitLogfileGroupOption(Context\LogfileGroupOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createServer()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateServer(Context\CreateServerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createServer()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateServer(Context\CreateServerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::serverOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterServerOptions(Context\ServerOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::serverOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitServerOptions(Context\ServerOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::serverOption()}.
	 * @param $context The parse tree.
	 */
	public function enterServerOption(Context\ServerOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::serverOption()}.
	 * @param $context The parse tree.
	 */
	public function exitServerOption(Context\ServerOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTablespace()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTablespace(Context\CreateTablespaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTablespace()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTablespace(Context\CreateTablespaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUndoTablespace(Context\CreateUndoTablespaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUndoTablespace(Context\CreateUndoTablespaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsDataFileName()}.
	 * @param $context The parse tree.
	 */
	public function enterTsDataFileName(Context\TsDataFileNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsDataFileName()}.
	 * @param $context The parse tree.
	 */
	public function exitTsDataFileName(Context\TsDataFileNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsDataFile()}.
	 * @param $context The parse tree.
	 */
	public function enterTsDataFile(Context\TsDataFileContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsDataFile()}.
	 * @param $context The parse tree.
	 */
	public function exitTsDataFile(Context\TsDataFileContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablespaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterTablespaceOptions(Context\TablespaceOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablespaceOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitTablespaceOptions(Context\TablespaceOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function enterTablespaceOption(Context\TablespaceOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablespaceOption()}.
	 * @param $context The parse tree.
	 */
	public function exitTablespaceOption(Context\TablespaceOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionInitialSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionInitialSize(Context\TsOptionInitialSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionInitialSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionInitialSize(Context\TsOptionInitialSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionUndoRedoBufferSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionUndoRedoBufferSize(Context\TsOptionUndoRedoBufferSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionUndoRedoBufferSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionUndoRedoBufferSize(Context\TsOptionUndoRedoBufferSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionAutoextendSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionAutoextendSize(Context\TsOptionAutoextendSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionAutoextendSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionAutoextendSize(Context\TsOptionAutoextendSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionMaxSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionMaxSize(Context\TsOptionMaxSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionMaxSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionMaxSize(Context\TsOptionMaxSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionExtentSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionExtentSize(Context\TsOptionExtentSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionExtentSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionExtentSize(Context\TsOptionExtentSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionNodegroup()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionNodegroup(Context\TsOptionNodegroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionNodegroup()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionNodegroup(Context\TsOptionNodegroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionEngine()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionEngine(Context\TsOptionEngineContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionEngine()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionEngine(Context\TsOptionEngineContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionWait()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionWait(Context\TsOptionWaitContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionWait()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionWait(Context\TsOptionWaitContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionComment()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionComment(Context\TsOptionCommentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionComment()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionComment(Context\TsOptionCommentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionFileblockSize()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionFileblockSize(Context\TsOptionFileblockSizeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionFileblockSize()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionFileblockSize(Context\TsOptionFileblockSizeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionEncryption()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionEncryption(Context\TsOptionEncryptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionEncryption()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionEncryption(Context\TsOptionEncryptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tsOptionEngineAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterTsOptionEngineAttribute(Context\TsOptionEngineAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tsOptionEngineAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitTsOptionEngineAttribute(Context\TsOptionEngineAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createView()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateView(Context\CreateViewContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createView()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateView(Context\CreateViewContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewReplaceOrAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterViewReplaceOrAlgorithm(Context\ViewReplaceOrAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewReplaceOrAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitViewReplaceOrAlgorithm(Context\ViewReplaceOrAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterViewAlgorithm(Context\ViewAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitViewAlgorithm(Context\ViewAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewSuid()}.
	 * @param $context The parse tree.
	 */
	public function enterViewSuid(Context\ViewSuidContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewSuid()}.
	 * @param $context The parse tree.
	 */
	public function exitViewSuid(Context\ViewSuidContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTrigger()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTrigger(Context\CreateTriggerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTrigger()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTrigger(Context\CreateTriggerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::triggerFollowsPrecedesClause()}.
	 * @param $context The parse tree.
	 */
	public function enterTriggerFollowsPrecedesClause(Context\TriggerFollowsPrecedesClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::triggerFollowsPrecedesClause()}.
	 * @param $context The parse tree.
	 */
	public function exitTriggerFollowsPrecedesClause(Context\TriggerFollowsPrecedesClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createEvent()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateEvent(Context\CreateEventContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createEvent()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateEvent(Context\CreateEventContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createRole()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateRole(Context\CreateRoleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createRole()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateRole(Context\CreateRoleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createSpatialReference()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateSpatialReference(Context\CreateSpatialReferenceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createSpatialReference()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateSpatialReference(Context\CreateSpatialReferenceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::srsAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterSrsAttribute(Context\SrsAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::srsAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitSrsAttribute(Context\SrsAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterDropStatement(Context\DropStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitDropStatement(Context\DropStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropDatabase()}.
	 * @param $context The parse tree.
	 */
	public function enterDropDatabase(Context\DropDatabaseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropDatabase()}.
	 * @param $context The parse tree.
	 */
	public function exitDropDatabase(Context\DropDatabaseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropEvent()}.
	 * @param $context The parse tree.
	 */
	public function enterDropEvent(Context\DropEventContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropEvent()}.
	 * @param $context The parse tree.
	 */
	public function exitDropEvent(Context\DropEventContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterDropFunction(Context\DropFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitDropFunction(Context\DropFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropProcedure()}.
	 * @param $context The parse tree.
	 */
	public function enterDropProcedure(Context\DropProcedureContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropProcedure()}.
	 * @param $context The parse tree.
	 */
	public function exitDropProcedure(Context\DropProcedureContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropIndex()}.
	 * @param $context The parse tree.
	 */
	public function enterDropIndex(Context\DropIndexContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropIndex()}.
	 * @param $context The parse tree.
	 */
	public function exitDropIndex(Context\DropIndexContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterDropLogfileGroup(Context\DropLogfileGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropLogfileGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitDropLogfileGroup(Context\DropLogfileGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropLogfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function enterDropLogfileGroupOption(Context\DropLogfileGroupOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropLogfileGroupOption()}.
	 * @param $context The parse tree.
	 */
	public function exitDropLogfileGroupOption(Context\DropLogfileGroupOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropServer()}.
	 * @param $context The parse tree.
	 */
	public function enterDropServer(Context\DropServerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropServer()}.
	 * @param $context The parse tree.
	 */
	public function exitDropServer(Context\DropServerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropTable()}.
	 * @param $context The parse tree.
	 */
	public function enterDropTable(Context\DropTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropTable()}.
	 * @param $context The parse tree.
	 */
	public function exitDropTable(Context\DropTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropTableSpace()}.
	 * @param $context The parse tree.
	 */
	public function enterDropTableSpace(Context\DropTableSpaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropTableSpace()}.
	 * @param $context The parse tree.
	 */
	public function exitDropTableSpace(Context\DropTableSpaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropTrigger()}.
	 * @param $context The parse tree.
	 */
	public function enterDropTrigger(Context\DropTriggerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropTrigger()}.
	 * @param $context The parse tree.
	 */
	public function exitDropTrigger(Context\DropTriggerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropView()}.
	 * @param $context The parse tree.
	 */
	public function enterDropView(Context\DropViewContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropView()}.
	 * @param $context The parse tree.
	 */
	public function exitDropView(Context\DropViewContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropRole()}.
	 * @param $context The parse tree.
	 */
	public function enterDropRole(Context\DropRoleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropRole()}.
	 * @param $context The parse tree.
	 */
	public function exitDropRole(Context\DropRoleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropSpatialReference()}.
	 * @param $context The parse tree.
	 */
	public function enterDropSpatialReference(Context\DropSpatialReferenceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropSpatialReference()}.
	 * @param $context The parse tree.
	 */
	public function exitDropSpatialReference(Context\DropSpatialReferenceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function enterDropUndoTablespace(Context\DropUndoTablespaceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropUndoTablespace()}.
	 * @param $context The parse tree.
	 */
	public function exitDropUndoTablespace(Context\DropUndoTablespaceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::renameTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterRenameTableStatement(Context\RenameTableStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::renameTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitRenameTableStatement(Context\RenameTableStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::renamePair()}.
	 * @param $context The parse tree.
	 */
	public function enterRenamePair(Context\RenamePairContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::renamePair()}.
	 * @param $context The parse tree.
	 */
	public function exitRenamePair(Context\RenamePairContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::truncateTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterTruncateTableStatement(Context\TruncateTableStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::truncateTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitTruncateTableStatement(Context\TruncateTableStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::importStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterImportStatement(Context\ImportStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::importStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitImportStatement(Context\ImportStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::callStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCallStatement(Context\CallStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::callStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCallStatement(Context\CallStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::deleteStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterDeleteStatement(Context\DeleteStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::deleteStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitDeleteStatement(Context\DeleteStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionDelete()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDelete(Context\PartitionDeleteContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionDelete()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDelete(Context\PartitionDeleteContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::deleteStatementOption()}.
	 * @param $context The parse tree.
	 */
	public function enterDeleteStatementOption(Context\DeleteStatementOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::deleteStatementOption()}.
	 * @param $context The parse tree.
	 */
	public function exitDeleteStatementOption(Context\DeleteStatementOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::doStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterDoStatement(Context\DoStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::doStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitDoStatement(Context\DoStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::handlerStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterHandlerStatement(Context\HandlerStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::handlerStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitHandlerStatement(Context\HandlerStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::handlerReadOrScan()}.
	 * @param $context The parse tree.
	 */
	public function enterHandlerReadOrScan(Context\HandlerReadOrScanContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::handlerReadOrScan()}.
	 * @param $context The parse tree.
	 */
	public function exitHandlerReadOrScan(Context\HandlerReadOrScanContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertStatement(Context\InsertStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertStatement(Context\InsertStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertLockOption()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertLockOption(Context\InsertLockOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertLockOption()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertLockOption(Context\InsertLockOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertFromConstructor()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertFromConstructor(Context\InsertFromConstructorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertFromConstructor()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertFromConstructor(Context\InsertFromConstructorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fields()}.
	 * @param $context The parse tree.
	 */
	public function enterFields(Context\FieldsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fields()}.
	 * @param $context The parse tree.
	 */
	public function exitFields(Context\FieldsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertValues()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertValues(Context\InsertValuesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertValues()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertValues(Context\InsertValuesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertQueryExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertQueryExpression(Context\InsertQueryExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertQueryExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertQueryExpression(Context\InsertQueryExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::valueList()}.
	 * @param $context The parse tree.
	 */
	public function enterValueList(Context\ValueListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::valueList()}.
	 * @param $context The parse tree.
	 */
	public function exitValueList(Context\ValueListContext $context): void;
	/**
	 * Enter a parse tree produced by the `values`
	 * labeled alternative in {@see MySQLParser::exprexprexprexprexprboolPriboolPriboolPriboolPripredicateOperationspredicateOperationspredicateOperationspredicateOperationssimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprpartitionTypeDefpartitionTypeDefpartitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function enterValues(Context\ValuesContext $context): void;
	/**
	 * Exit a parse tree produced by the `values` labeled alternative
	 * in {@see MySQLParser::exprexprexprexprexprboolPriboolPriboolPriboolPripredicateOperationspredicateOperationspredicateOperationspredicateOperationssimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprsimpleExprpartitionTypeDefpartitionTypeDefpartitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function exitValues(Context\ValuesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::valuesReference()}.
	 * @param $context The parse tree.
	 */
	public function enterValuesReference(Context\ValuesReferenceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::valuesReference()}.
	 * @param $context The parse tree.
	 */
	public function exitValuesReference(Context\ValuesReferenceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertUpdateList()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertUpdateList(Context\InsertUpdateListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertUpdateList()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertUpdateList(Context\InsertUpdateListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadStatement(Context\LoadStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadStatement(Context\LoadStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dataOrXml()}.
	 * @param $context The parse tree.
	 */
	public function enterDataOrXml(Context\DataOrXmlContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dataOrXml()}.
	 * @param $context The parse tree.
	 */
	public function exitDataOrXml(Context\DataOrXmlContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadDataLock()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadDataLock(Context\LoadDataLockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadDataLock()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadDataLock(Context\LoadDataLockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadFrom()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadFrom(Context\LoadFromContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadFrom()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadFrom(Context\LoadFromContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadSourceType()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadSourceType(Context\LoadSourceTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadSourceType()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadSourceType(Context\LoadSourceTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceCount()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceCount(Context\SourceCountContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceCount()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceCount(Context\SourceCountContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceOrder()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceOrder(Context\SourceOrderContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceOrder()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceOrder(Context\SourceOrderContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::xmlRowsIdentifiedBy()}.
	 * @param $context The parse tree.
	 */
	public function enterXmlRowsIdentifiedBy(Context\XmlRowsIdentifiedByContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::xmlRowsIdentifiedBy()}.
	 * @param $context The parse tree.
	 */
	public function exitXmlRowsIdentifiedBy(Context\XmlRowsIdentifiedByContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadDataFileTail()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadDataFileTail(Context\LoadDataFileTailContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadDataFileTail()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadDataFileTail(Context\LoadDataFileTailContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadDataFileTargetList()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadDataFileTargetList(Context\LoadDataFileTargetListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadDataFileTargetList()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadDataFileTargetList(Context\LoadDataFileTargetListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldOrVariableList()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldOrVariableList(Context\FieldOrVariableListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldOrVariableList()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldOrVariableList(Context\FieldOrVariableListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadAlgorithm(Context\LoadAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadAlgorithm(Context\LoadAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadParallel()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadParallel(Context\LoadParallelContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadParallel()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadParallel(Context\LoadParallelContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loadMemory()}.
	 * @param $context The parse tree.
	 */
	public function enterLoadMemory(Context\LoadMemoryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loadMemory()}.
	 * @param $context The parse tree.
	 */
	public function exitLoadMemory(Context\LoadMemoryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replaceStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterReplaceStatement(Context\ReplaceStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replaceStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitReplaceStatement(Context\ReplaceStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectStatement(Context\SelectStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectStatement(Context\SelectStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectStatementWithInto()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectStatementWithInto(Context\SelectStatementWithIntoContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectStatementWithInto()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectStatementWithInto(Context\SelectStatementWithIntoContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryExpression(Context\QueryExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryExpression(Context\QueryExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryExpressionBody()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryExpressionBody(Context\QueryExpressionBodyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryExpressionBody()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryExpressionBody(Context\QueryExpressionBodyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryExpressionParens()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryExpressionParens(Context\QueryExpressionParensContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryExpressionParens()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryExpressionParens(Context\QueryExpressionParensContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::queryPrimary()}.
	 * @param $context The parse tree.
	 */
	public function enterQueryPrimary(Context\QueryPrimaryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::queryPrimary()}.
	 * @param $context The parse tree.
	 */
	public function exitQueryPrimary(Context\QueryPrimaryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::querySpecification()}.
	 * @param $context The parse tree.
	 */
	public function enterQuerySpecification(Context\QuerySpecificationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::querySpecification()}.
	 * @param $context The parse tree.
	 */
	public function exitQuerySpecification(Context\QuerySpecificationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::subquery()}.
	 * @param $context The parse tree.
	 */
	public function enterSubquery(Context\SubqueryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::subquery()}.
	 * @param $context The parse tree.
	 */
	public function exitSubquery(Context\SubqueryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::querySpecOption()}.
	 * @param $context The parse tree.
	 */
	public function enterQuerySpecOption(Context\QuerySpecOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::querySpecOption()}.
	 * @param $context The parse tree.
	 */
	public function exitQuerySpecOption(Context\QuerySpecOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::limitClause()}.
	 * @param $context The parse tree.
	 */
	public function enterLimitClause(Context\LimitClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::limitClause()}.
	 * @param $context The parse tree.
	 */
	public function exitLimitClause(Context\LimitClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::simpleLimitClause()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleLimitClause(Context\SimpleLimitClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::simpleLimitClause()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleLimitClause(Context\SimpleLimitClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::limitOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterLimitOptions(Context\LimitOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::limitOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitLimitOptions(Context\LimitOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::limitOption()}.
	 * @param $context The parse tree.
	 */
	public function enterLimitOption(Context\LimitOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::limitOption()}.
	 * @param $context The parse tree.
	 */
	public function exitLimitOption(Context\LimitOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::intoClause()}.
	 * @param $context The parse tree.
	 */
	public function enterIntoClause(Context\IntoClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::intoClause()}.
	 * @param $context The parse tree.
	 */
	public function exitIntoClause(Context\IntoClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::procedureAnalyseClause()}.
	 * @param $context The parse tree.
	 */
	public function enterProcedureAnalyseClause(Context\ProcedureAnalyseClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::procedureAnalyseClause()}.
	 * @param $context The parse tree.
	 */
	public function exitProcedureAnalyseClause(Context\ProcedureAnalyseClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::havingClause()}.
	 * @param $context The parse tree.
	 */
	public function enterHavingClause(Context\HavingClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::havingClause()}.
	 * @param $context The parse tree.
	 */
	public function exitHavingClause(Context\HavingClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::qualifyClause()}.
	 * @param $context The parse tree.
	 */
	public function enterQualifyClause(Context\QualifyClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::qualifyClause()}.
	 * @param $context The parse tree.
	 */
	public function exitQualifyClause(Context\QualifyClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowClause()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowClause(Context\WindowClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowClause()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowClause(Context\WindowClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowDefinition(Context\WindowDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowDefinition(Context\WindowDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowSpec()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowSpec(Context\WindowSpecContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowSpec()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowSpec(Context\WindowSpecContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowSpecDetails()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowSpecDetails(Context\WindowSpecDetailsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowSpecDetails()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowSpecDetails(Context\WindowSpecDetailsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameClause()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameClause(Context\WindowFrameClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameClause()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameClause(Context\WindowFrameClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameUnits()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameUnits(Context\WindowFrameUnitsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameUnits()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameUnits(Context\WindowFrameUnitsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameExtent()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameExtent(Context\WindowFrameExtentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameExtent()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameExtent(Context\WindowFrameExtentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameStart()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameStart(Context\WindowFrameStartContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameStart()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameStart(Context\WindowFrameStartContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameBetween()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameBetween(Context\WindowFrameBetweenContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameBetween()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameBetween(Context\WindowFrameBetweenContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameBound()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameBound(Context\WindowFrameBoundContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameBound()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameBound(Context\WindowFrameBoundContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFrameExclusion()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFrameExclusion(Context\WindowFrameExclusionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFrameExclusion()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFrameExclusion(Context\WindowFrameExclusionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::withClause()}.
	 * @param $context The parse tree.
	 */
	public function enterWithClause(Context\WithClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::withClause()}.
	 * @param $context The parse tree.
	 */
	public function exitWithClause(Context\WithClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::commonTableExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterCommonTableExpression(Context\CommonTableExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::commonTableExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitCommonTableExpression(Context\CommonTableExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupByClause()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupByClause(Context\GroupByClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupByClause()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupByClause(Context\GroupByClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::olapOption()}.
	 * @param $context The parse tree.
	 */
	public function enterOlapOption(Context\OlapOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::olapOption()}.
	 * @param $context The parse tree.
	 */
	public function exitOlapOption(Context\OlapOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::orderClause()}.
	 * @param $context The parse tree.
	 */
	public function enterOrderClause(Context\OrderClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::orderClause()}.
	 * @param $context The parse tree.
	 */
	public function exitOrderClause(Context\OrderClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::direction()}.
	 * @param $context The parse tree.
	 */
	public function enterDirection(Context\DirectionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::direction()}.
	 * @param $context The parse tree.
	 */
	public function exitDirection(Context\DirectionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fromClause()}.
	 * @param $context The parse tree.
	 */
	public function enterFromClause(Context\FromClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fromClause()}.
	 * @param $context The parse tree.
	 */
	public function exitFromClause(Context\FromClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableReferenceList()}.
	 * @param $context The parse tree.
	 */
	public function enterTableReferenceList(Context\TableReferenceListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableReferenceList()}.
	 * @param $context The parse tree.
	 */
	public function exitTableReferenceList(Context\TableReferenceListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableValueConstructor()}.
	 * @param $context The parse tree.
	 */
	public function enterTableValueConstructor(Context\TableValueConstructorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableValueConstructor()}.
	 * @param $context The parse tree.
	 */
	public function exitTableValueConstructor(Context\TableValueConstructorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::explicitTable()}.
	 * @param $context The parse tree.
	 */
	public function enterExplicitTable(Context\ExplicitTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::explicitTable()}.
	 * @param $context The parse tree.
	 */
	public function exitExplicitTable(Context\ExplicitTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::rowValueExplicit()}.
	 * @param $context The parse tree.
	 */
	public function enterRowValueExplicit(Context\RowValueExplicitContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::rowValueExplicit()}.
	 * @param $context The parse tree.
	 */
	public function exitRowValueExplicit(Context\RowValueExplicitContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectOption()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectOption(Context\SelectOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectOption()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectOption(Context\SelectOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockingClauseList()}.
	 * @param $context The parse tree.
	 */
	public function enterLockingClauseList(Context\LockingClauseListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockingClauseList()}.
	 * @param $context The parse tree.
	 */
	public function exitLockingClauseList(Context\LockingClauseListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockingClause()}.
	 * @param $context The parse tree.
	 */
	public function enterLockingClause(Context\LockingClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockingClause()}.
	 * @param $context The parse tree.
	 */
	public function exitLockingClause(Context\LockingClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockStrengh()}.
	 * @param $context The parse tree.
	 */
	public function enterLockStrengh(Context\LockStrenghContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockStrengh()}.
	 * @param $context The parse tree.
	 */
	public function exitLockStrengh(Context\LockStrenghContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockedRowAction()}.
	 * @param $context The parse tree.
	 */
	public function enterLockedRowAction(Context\LockedRowActionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockedRowAction()}.
	 * @param $context The parse tree.
	 */
	public function exitLockedRowAction(Context\LockedRowActionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectItemList()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectItemList(Context\SelectItemListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectItemList()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectItemList(Context\SelectItemListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectItem()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectItem(Context\SelectItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectItem()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectItem(Context\SelectItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::selectAlias()}.
	 * @param $context The parse tree.
	 */
	public function enterSelectAlias(Context\SelectAliasContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::selectAlias()}.
	 * @param $context The parse tree.
	 */
	public function exitSelectAlias(Context\SelectAliasContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::whereClause()}.
	 * @param $context The parse tree.
	 */
	public function enterWhereClause(Context\WhereClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::whereClause()}.
	 * @param $context The parse tree.
	 */
	public function exitWhereClause(Context\WhereClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableReference()}.
	 * @param $context The parse tree.
	 */
	public function enterTableReference(Context\TableReferenceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableReference()}.
	 * @param $context The parse tree.
	 */
	public function exitTableReference(Context\TableReferenceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::escapedTableReference()}.
	 * @param $context The parse tree.
	 */
	public function enterEscapedTableReference(Context\EscapedTableReferenceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::escapedTableReference()}.
	 * @param $context The parse tree.
	 */
	public function exitEscapedTableReference(Context\EscapedTableReferenceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::joinedTable()}.
	 * @param $context The parse tree.
	 */
	public function enterJoinedTable(Context\JoinedTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::joinedTable()}.
	 * @param $context The parse tree.
	 */
	public function exitJoinedTable(Context\JoinedTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::naturalJoinType()}.
	 * @param $context The parse tree.
	 */
	public function enterNaturalJoinType(Context\NaturalJoinTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::naturalJoinType()}.
	 * @param $context The parse tree.
	 */
	public function exitNaturalJoinType(Context\NaturalJoinTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::innerJoinType()}.
	 * @param $context The parse tree.
	 */
	public function enterInnerJoinType(Context\InnerJoinTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::innerJoinType()}.
	 * @param $context The parse tree.
	 */
	public function exitInnerJoinType(Context\InnerJoinTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::outerJoinType()}.
	 * @param $context The parse tree.
	 */
	public function enterOuterJoinType(Context\OuterJoinTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::outerJoinType()}.
	 * @param $context The parse tree.
	 */
	public function exitOuterJoinType(Context\OuterJoinTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableFactor()}.
	 * @param $context The parse tree.
	 */
	public function enterTableFactor(Context\TableFactorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableFactor()}.
	 * @param $context The parse tree.
	 */
	public function exitTableFactor(Context\TableFactorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::singleTable()}.
	 * @param $context The parse tree.
	 */
	public function enterSingleTable(Context\SingleTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::singleTable()}.
	 * @param $context The parse tree.
	 */
	public function exitSingleTable(Context\SingleTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::singleTableParens()}.
	 * @param $context The parse tree.
	 */
	public function enterSingleTableParens(Context\SingleTableParensContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::singleTableParens()}.
	 * @param $context The parse tree.
	 */
	public function exitSingleTableParens(Context\SingleTableParensContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::derivedTable()}.
	 * @param $context The parse tree.
	 */
	public function enterDerivedTable(Context\DerivedTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::derivedTable()}.
	 * @param $context The parse tree.
	 */
	public function exitDerivedTable(Context\DerivedTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableReferenceListParens()}.
	 * @param $context The parse tree.
	 */
	public function enterTableReferenceListParens(Context\TableReferenceListParensContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableReferenceListParens()}.
	 * @param $context The parse tree.
	 */
	public function exitTableReferenceListParens(Context\TableReferenceListParensContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterTableFunction(Context\TableFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitTableFunction(Context\TableFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnsClause()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnsClause(Context\ColumnsClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnsClause()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnsClause(Context\ColumnsClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::jtColumn()}.
	 * @param $context The parse tree.
	 */
	public function enterJtColumn(Context\JtColumnContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::jtColumn()}.
	 * @param $context The parse tree.
	 */
	public function exitJtColumn(Context\JtColumnContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::onEmptyOrError()}.
	 * @param $context The parse tree.
	 */
	public function enterOnEmptyOrError(Context\OnEmptyOrErrorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::onEmptyOrError()}.
	 * @param $context The parse tree.
	 */
	public function exitOnEmptyOrError(Context\OnEmptyOrErrorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::onEmptyOrErrorJsonTable()}.
	 * @param $context The parse tree.
	 */
	public function enterOnEmptyOrErrorJsonTable(Context\OnEmptyOrErrorJsonTableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::onEmptyOrErrorJsonTable()}.
	 * @param $context The parse tree.
	 */
	public function exitOnEmptyOrErrorJsonTable(Context\OnEmptyOrErrorJsonTableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::onEmpty()}.
	 * @param $context The parse tree.
	 */
	public function enterOnEmpty(Context\OnEmptyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::onEmpty()}.
	 * @param $context The parse tree.
	 */
	public function exitOnEmpty(Context\OnEmptyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::onError()}.
	 * @param $context The parse tree.
	 */
	public function enterOnError(Context\OnErrorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::onError()}.
	 * @param $context The parse tree.
	 */
	public function exitOnError(Context\OnErrorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::jsonOnResponse()}.
	 * @param $context The parse tree.
	 */
	public function enterJsonOnResponse(Context\JsonOnResponseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::jsonOnResponse()}.
	 * @param $context The parse tree.
	 */
	public function exitJsonOnResponse(Context\JsonOnResponseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::unionOption()}.
	 * @param $context The parse tree.
	 */
	public function enterUnionOption(Context\UnionOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::unionOption()}.
	 * @param $context The parse tree.
	 */
	public function exitUnionOption(Context\UnionOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableAlias()}.
	 * @param $context The parse tree.
	 */
	public function enterTableAlias(Context\TableAliasContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableAlias()}.
	 * @param $context The parse tree.
	 */
	public function exitTableAlias(Context\TableAliasContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexHintList()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexHintList(Context\IndexHintListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexHintList()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexHintList(Context\IndexHintListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexHint()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexHint(Context\IndexHintContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexHint()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexHint(Context\IndexHintContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexHintType()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexHintType(Context\IndexHintTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexHintType()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexHintType(Context\IndexHintTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyOrIndex()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyOrIndex(Context\KeyOrIndexContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyOrIndex()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyOrIndex(Context\KeyOrIndexContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::constraintKeyType()}.
	 * @param $context The parse tree.
	 */
	public function enterConstraintKeyType(Context\ConstraintKeyTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::constraintKeyType()}.
	 * @param $context The parse tree.
	 */
	public function exitConstraintKeyType(Context\ConstraintKeyTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexHintClause()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexHintClause(Context\IndexHintClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexHintClause()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexHintClause(Context\IndexHintClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexList()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexList(Context\IndexListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexList()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexList(Context\IndexListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexListElement()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexListElement(Context\IndexListElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexListElement()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexListElement(Context\IndexListElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::updateStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterUpdateStatement(Context\UpdateStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::updateStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitUpdateStatement(Context\UpdateStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::transactionOrLockingStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterTransactionOrLockingStatement(Context\TransactionOrLockingStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::transactionOrLockingStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitTransactionOrLockingStatement(Context\TransactionOrLockingStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::transactionStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterTransactionStatement(Context\TransactionStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::transactionStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitTransactionStatement(Context\TransactionStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::beginWork()}.
	 * @param $context The parse tree.
	 */
	public function enterBeginWork(Context\BeginWorkContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::beginWork()}.
	 * @param $context The parse tree.
	 */
	public function exitBeginWork(Context\BeginWorkContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::startTransactionOptionList()}.
	 * @param $context The parse tree.
	 */
	public function enterStartTransactionOptionList(Context\StartTransactionOptionListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::startTransactionOptionList()}.
	 * @param $context The parse tree.
	 */
	public function exitStartTransactionOptionList(Context\StartTransactionOptionListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::savepointStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSavepointStatement(Context\SavepointStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::savepointStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSavepointStatement(Context\SavepointStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterLockStatement(Context\LockStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitLockStatement(Context\LockStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockItem()}.
	 * @param $context The parse tree.
	 */
	public function enterLockItem(Context\LockItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockItem()}.
	 * @param $context The parse tree.
	 */
	public function exitLockItem(Context\LockItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lockOption()}.
	 * @param $context The parse tree.
	 */
	public function enterLockOption(Context\LockOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lockOption()}.
	 * @param $context The parse tree.
	 */
	public function exitLockOption(Context\LockOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::xaStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterXaStatement(Context\XaStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::xaStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitXaStatement(Context\XaStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::xaConvert()}.
	 * @param $context The parse tree.
	 */
	public function enterXaConvert(Context\XaConvertContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::xaConvert()}.
	 * @param $context The parse tree.
	 */
	public function exitXaConvert(Context\XaConvertContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::xid()}.
	 * @param $context The parse tree.
	 */
	public function enterXid(Context\XidContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::xid()}.
	 * @param $context The parse tree.
	 */
	public function exitXid(Context\XidContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replicationStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterReplicationStatement(Context\ReplicationStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replicationStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitReplicationStatement(Context\ReplicationStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::purgeOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterPurgeOptions(Context\PurgeOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::purgeOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitPurgeOptions(Context\PurgeOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resetOption()}.
	 * @param $context The parse tree.
	 */
	public function enterResetOption(Context\ResetOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resetOption()}.
	 * @param $context The parse tree.
	 */
	public function exitResetOption(Context\ResetOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::masterOrBinaryLogsAndGtids()}.
	 * @param $context The parse tree.
	 */
	public function enterMasterOrBinaryLogsAndGtids(Context\MasterOrBinaryLogsAndGtidsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::masterOrBinaryLogsAndGtids()}.
	 * @param $context The parse tree.
	 */
	public function exitMasterOrBinaryLogsAndGtids(Context\MasterOrBinaryLogsAndGtidsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceResetOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceResetOptions(Context\SourceResetOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceResetOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceResetOptions(Context\SourceResetOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replicationLoad()}.
	 * @param $context The parse tree.
	 */
	public function enterReplicationLoad(Context\ReplicationLoadContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replicationLoad()}.
	 * @param $context The parse tree.
	 */
	public function exitReplicationLoad(Context\ReplicationLoadContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSource()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSource(Context\ChangeReplicationSourceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSource()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSource(Context\ChangeReplicationSourceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeSource()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeSource(Context\ChangeSourceContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeSource()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeSource(Context\ChangeSourceContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceDefinitions(Context\SourceDefinitionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceDefinitions(Context\SourceDefinitionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceDefinition(Context\SourceDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceDefinition(Context\SourceDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceAutoPosition()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceAutoPosition(Context\ChangeReplicationSourceAutoPositionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceAutoPosition()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceAutoPosition(Context\ChangeReplicationSourceAutoPositionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceHost()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceHost(Context\ChangeReplicationSourceHostContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceHost()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceHost(Context\ChangeReplicationSourceHostContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceBind()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceBind(Context\ChangeReplicationSourceBindContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceBind()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceBind(Context\ChangeReplicationSourceBindContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceUser()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceUser(Context\ChangeReplicationSourceUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceUser()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceUser(Context\ChangeReplicationSourceUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourcePassword()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourcePassword(Context\ChangeReplicationSourcePasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourcePassword()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourcePassword(Context\ChangeReplicationSourcePasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourcePort()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourcePort(Context\ChangeReplicationSourcePortContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourcePort()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourcePort(Context\ChangeReplicationSourcePortContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceConnectRetry()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceConnectRetry(Context\ChangeReplicationSourceConnectRetryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceConnectRetry()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceConnectRetry(Context\ChangeReplicationSourceConnectRetryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceRetryCount()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceRetryCount(Context\ChangeReplicationSourceRetryCountContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceRetryCount()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceRetryCount(Context\ChangeReplicationSourceRetryCountContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceDelay()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceDelay(Context\ChangeReplicationSourceDelayContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceDelay()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceDelay(Context\ChangeReplicationSourceDelayContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSL()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSL(Context\ChangeReplicationSourceSSLContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSL()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSL(Context\ChangeReplicationSourceSSLContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCA()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCA(Context\ChangeReplicationSourceSSLCAContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCA()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCA(Context\ChangeReplicationSourceSSLCAContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCApath()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCApath(Context\ChangeReplicationSourceSSLCApathContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCApath()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCApath(Context\ChangeReplicationSourceSSLCApathContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCipher()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCipher(Context\ChangeReplicationSourceSSLCipherContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCipher()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCipher(Context\ChangeReplicationSourceSSLCipherContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCLR()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCLR(Context\ChangeReplicationSourceSSLCLRContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCLR()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCLR(Context\ChangeReplicationSourceSSLCLRContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCLRpath()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCLRpath(Context\ChangeReplicationSourceSSLCLRpathContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCLRpath()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCLRpath(Context\ChangeReplicationSourceSSLCLRpathContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLKey()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLKey(Context\ChangeReplicationSourceSSLKeyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLKey()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLKey(Context\ChangeReplicationSourceSSLKeyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLVerifyServerCert()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLVerifyServerCert(Context\ChangeReplicationSourceSSLVerifyServerCertContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLVerifyServerCert()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLVerifyServerCert(Context\ChangeReplicationSourceSSLVerifyServerCertContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceTLSVersion()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceTLSVersion(Context\ChangeReplicationSourceTLSVersionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceTLSVersion()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceTLSVersion(Context\ChangeReplicationSourceTLSVersionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceTLSCiphersuites()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceTLSCiphersuites(Context\ChangeReplicationSourceTLSCiphersuitesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceTLSCiphersuites()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceTLSCiphersuites(Context\ChangeReplicationSourceTLSCiphersuitesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCert()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceSSLCert(Context\ChangeReplicationSourceSSLCertContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceSSLCert()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceSSLCert(Context\ChangeReplicationSourceSSLCertContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourcePublicKey()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourcePublicKey(Context\ChangeReplicationSourcePublicKeyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourcePublicKey()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourcePublicKey(Context\ChangeReplicationSourcePublicKeyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceGetSourcePublicKey()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceGetSourcePublicKey(Context\ChangeReplicationSourceGetSourcePublicKeyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceGetSourcePublicKey()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceGetSourcePublicKey(Context\ChangeReplicationSourceGetSourcePublicKeyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceHeartbeatPeriod()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceHeartbeatPeriod(Context\ChangeReplicationSourceHeartbeatPeriodContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceHeartbeatPeriod()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceHeartbeatPeriod(Context\ChangeReplicationSourceHeartbeatPeriodContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceCompressionAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceCompressionAlgorithm(Context\ChangeReplicationSourceCompressionAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceCompressionAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceCompressionAlgorithm(Context\ChangeReplicationSourceCompressionAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplicationSourceZstdCompressionLevel()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplicationSourceZstdCompressionLevel(Context\ChangeReplicationSourceZstdCompressionLevelContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplicationSourceZstdCompressionLevel()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplicationSourceZstdCompressionLevel(Context\ChangeReplicationSourceZstdCompressionLevelContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::privilegeCheckDef()}.
	 * @param $context The parse tree.
	 */
	public function enterPrivilegeCheckDef(Context\PrivilegeCheckDefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::privilegeCheckDef()}.
	 * @param $context The parse tree.
	 */
	public function exitPrivilegeCheckDef(Context\PrivilegeCheckDefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablePrimaryKeyCheckDef()}.
	 * @param $context The parse tree.
	 */
	public function enterTablePrimaryKeyCheckDef(Context\TablePrimaryKeyCheckDefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablePrimaryKeyCheckDef()}.
	 * @param $context The parse tree.
	 */
	public function exitTablePrimaryKeyCheckDef(Context\TablePrimaryKeyCheckDefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::assignGtidsToAnonymousTransactionsDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignGtidsToAnonymousTransactionsDefinition(Context\AssignGtidsToAnonymousTransactionsDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::assignGtidsToAnonymousTransactionsDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignGtidsToAnonymousTransactionsDefinition(Context\AssignGtidsToAnonymousTransactionsDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceTlsCiphersuitesDef()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceTlsCiphersuitesDef(Context\SourceTlsCiphersuitesDefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceTlsCiphersuitesDef()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceTlsCiphersuitesDef(Context\SourceTlsCiphersuitesDefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceFileDef()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceFileDef(Context\SourceFileDefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceFileDef()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceFileDef(Context\SourceFileDefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceLogFile()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceLogFile(Context\SourceLogFileContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceLogFile()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceLogFile(Context\SourceLogFileContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sourceLogPos()}.
	 * @param $context The parse tree.
	 */
	public function enterSourceLogPos(Context\SourceLogPosContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sourceLogPos()}.
	 * @param $context The parse tree.
	 */
	public function exitSourceLogPos(Context\SourceLogPosContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::serverIdList()}.
	 * @param $context The parse tree.
	 */
	public function enterServerIdList(Context\ServerIdListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::serverIdList()}.
	 * @param $context The parse tree.
	 */
	public function exitServerIdList(Context\ServerIdListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::changeReplication()}.
	 * @param $context The parse tree.
	 */
	public function enterChangeReplication(Context\ChangeReplicationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::changeReplication()}.
	 * @param $context The parse tree.
	 */
	public function exitChangeReplication(Context\ChangeReplicationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterDefinition(Context\FilterDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterDefinition(Context\FilterDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterDbList()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterDbList(Context\FilterDbListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterDbList()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterDbList(Context\FilterDbListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterTableList()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterTableList(Context\FilterTableListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterTableList()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterTableList(Context\FilterTableListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterStringList()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterStringList(Context\FilterStringListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterStringList()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterStringList(Context\FilterStringListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterWildDbTableString()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterWildDbTableString(Context\FilterWildDbTableStringContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterWildDbTableString()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterWildDbTableString(Context\FilterWildDbTableStringContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterDbPairList()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterDbPairList(Context\FilterDbPairListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterDbPairList()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterDbPairList(Context\FilterDbPairListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::startReplicaStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterStartReplicaStatement(Context\StartReplicaStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::startReplicaStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitStartReplicaStatement(Context\StartReplicaStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::stopReplicaStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterStopReplicaStatement(Context\StopReplicaStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::stopReplicaStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitStopReplicaStatement(Context\StopReplicaStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replicaUntil()}.
	 * @param $context The parse tree.
	 */
	public function enterReplicaUntil(Context\ReplicaUntilContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replicaUntil()}.
	 * @param $context The parse tree.
	 */
	public function exitReplicaUntil(Context\ReplicaUntilContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userOption()}.
	 * @param $context The parse tree.
	 */
	public function enterUserOption(Context\UserOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userOption()}.
	 * @param $context The parse tree.
	 */
	public function exitUserOption(Context\UserOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::passwordOption()}.
	 * @param $context The parse tree.
	 */
	public function enterPasswordOption(Context\PasswordOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::passwordOption()}.
	 * @param $context The parse tree.
	 */
	public function exitPasswordOption(Context\PasswordOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::defaultAuthOption()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultAuthOption(Context\DefaultAuthOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::defaultAuthOption()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultAuthOption(Context\DefaultAuthOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::pluginDirOption()}.
	 * @param $context The parse tree.
	 */
	public function enterPluginDirOption(Context\PluginDirOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::pluginDirOption()}.
	 * @param $context The parse tree.
	 */
	public function exitPluginDirOption(Context\PluginDirOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replicaThreadOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterReplicaThreadOptions(Context\ReplicaThreadOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replicaThreadOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitReplicaThreadOptions(Context\ReplicaThreadOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replicaThreadOption()}.
	 * @param $context The parse tree.
	 */
	public function enterReplicaThreadOption(Context\ReplicaThreadOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replicaThreadOption()}.
	 * @param $context The parse tree.
	 */
	public function exitReplicaThreadOption(Context\ReplicaThreadOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplication()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplication(Context\GroupReplicationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplication()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplication(Context\GroupReplicationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplicationStartOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplicationStartOptions(Context\GroupReplicationStartOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplicationStartOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplicationStartOptions(Context\GroupReplicationStartOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplicationStartOption()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplicationStartOption(Context\GroupReplicationStartOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplicationStartOption()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplicationStartOption(Context\GroupReplicationStartOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplicationUser()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplicationUser(Context\GroupReplicationUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplicationUser()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplicationUser(Context\GroupReplicationUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplicationPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplicationPassword(Context\GroupReplicationPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplicationPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplicationPassword(Context\GroupReplicationPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupReplicationPluginAuth()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupReplicationPluginAuth(Context\GroupReplicationPluginAuthContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupReplicationPluginAuth()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupReplicationPluginAuth(Context\GroupReplicationPluginAuthContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replica()}.
	 * @param $context The parse tree.
	 */
	public function enterReplica(Context\ReplicaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replica()}.
	 * @param $context The parse tree.
	 */
	public function exitReplica(Context\ReplicaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::preparedStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterPreparedStatement(Context\PreparedStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::preparedStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitPreparedStatement(Context\PreparedStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::executeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterExecuteStatement(Context\ExecuteStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::executeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitExecuteStatement(Context\ExecuteStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::executeVarList()}.
	 * @param $context The parse tree.
	 */
	public function enterExecuteVarList(Context\ExecuteVarListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::executeVarList()}.
	 * @param $context The parse tree.
	 */
	public function exitExecuteVarList(Context\ExecuteVarListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cloneStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCloneStatement(Context\CloneStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cloneStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCloneStatement(Context\CloneStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dataDirSSL()}.
	 * @param $context The parse tree.
	 */
	public function enterDataDirSSL(Context\DataDirSSLContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dataDirSSL()}.
	 * @param $context The parse tree.
	 */
	public function exitDataDirSSL(Context\DataDirSSLContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ssl()}.
	 * @param $context The parse tree.
	 */
	public function enterSsl(Context\SslContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ssl()}.
	 * @param $context The parse tree.
	 */
	public function exitSsl(Context\SslContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::accountManagementStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterAccountManagementStatement(Context\AccountManagementStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::accountManagementStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitAccountManagementStatement(Context\AccountManagementStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterUserStatement(Context\AlterUserStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterUserStatement(Context\AlterUserStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterUserList()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterUserList(Context\AlterUserListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterUserList()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterUserList(Context\AlterUserListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterUser()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterUser(Context\AlterUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterUser()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterUser(Context\AlterUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::oldAlterUser()}.
	 * @param $context The parse tree.
	 */
	public function enterOldAlterUser(Context\OldAlterUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::oldAlterUser()}.
	 * @param $context The parse tree.
	 */
	public function exitOldAlterUser(Context\OldAlterUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterUserFunction(Context\UserFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitUserFunction(Context\UserFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUserStatement(Context\CreateUserStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUserStatement(Context\CreateUserStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUserTail()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUserTail(Context\CreateUserTailContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUserTail()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUserTail(Context\CreateUserTailContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userAttributes()}.
	 * @param $context The parse tree.
	 */
	public function enterUserAttributes(Context\UserAttributesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userAttributes()}.
	 * @param $context The parse tree.
	 */
	public function exitUserAttributes(Context\UserAttributesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::defaultRoleClause()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultRoleClause(Context\DefaultRoleClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::defaultRoleClause()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultRoleClause(Context\DefaultRoleClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::requireClause()}.
	 * @param $context The parse tree.
	 */
	public function enterRequireClause(Context\RequireClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::requireClause()}.
	 * @param $context The parse tree.
	 */
	public function exitRequireClause(Context\RequireClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::connectOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterConnectOptions(Context\ConnectOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::connectOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitConnectOptions(Context\ConnectOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::accountLockPasswordExpireOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterAccountLockPasswordExpireOptions(Context\AccountLockPasswordExpireOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::accountLockPasswordExpireOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitAccountLockPasswordExpireOptions(Context\AccountLockPasswordExpireOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterUserAttribute(Context\UserAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitUserAttribute(Context\UserAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterDropUserStatement(Context\DropUserStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitDropUserStatement(Context\DropUserStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantStatement(Context\GrantStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantStatement(Context\GrantStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantTargetList()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantTargetList(Context\GrantTargetListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantTargetList()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantTargetList(Context\GrantTargetListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantOptions(Context\GrantOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantOptions(Context\GrantOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::exceptRoleList()}.
	 * @param $context The parse tree.
	 */
	public function enterExceptRoleList(Context\ExceptRoleListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::exceptRoleList()}.
	 * @param $context The parse tree.
	 */
	public function exitExceptRoleList(Context\ExceptRoleListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::withRoles()}.
	 * @param $context The parse tree.
	 */
	public function enterWithRoles(Context\WithRolesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::withRoles()}.
	 * @param $context The parse tree.
	 */
	public function exitWithRoles(Context\WithRolesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantAs()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantAs(Context\GrantAsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantAs()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantAs(Context\GrantAsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::versionedRequireClause()}.
	 * @param $context The parse tree.
	 */
	public function enterVersionedRequireClause(Context\VersionedRequireClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::versionedRequireClause()}.
	 * @param $context The parse tree.
	 */
	public function exitVersionedRequireClause(Context\VersionedRequireClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::renameUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterRenameUserStatement(Context\RenameUserStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::renameUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitRenameUserStatement(Context\RenameUserStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::revokeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterRevokeStatement(Context\RevokeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::revokeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitRevokeStatement(Context\RevokeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::aclType()}.
	 * @param $context The parse tree.
	 */
	public function enterAclType(Context\AclTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::aclType()}.
	 * @param $context The parse tree.
	 */
	public function exitAclType(Context\AclTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleOrPrivilegesList()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleOrPrivilegesList(Context\RoleOrPrivilegesListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleOrPrivilegesList()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleOrPrivilegesList(Context\RoleOrPrivilegesListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleOrPrivilege()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleOrPrivilege(Context\RoleOrPrivilegeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleOrPrivilege()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleOrPrivilege(Context\RoleOrPrivilegeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantIdentifier(Context\GrantIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantIdentifier(Context\GrantIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::requireList()}.
	 * @param $context The parse tree.
	 */
	public function enterRequireList(Context\RequireListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::requireList()}.
	 * @param $context The parse tree.
	 */
	public function exitRequireList(Context\RequireListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::requireListElement()}.
	 * @param $context The parse tree.
	 */
	public function enterRequireListElement(Context\RequireListElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::requireListElement()}.
	 * @param $context The parse tree.
	 */
	public function exitRequireListElement(Context\RequireListElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::grantOption()}.
	 * @param $context The parse tree.
	 */
	public function enterGrantOption(Context\GrantOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::grantOption()}.
	 * @param $context The parse tree.
	 */
	public function exitGrantOption(Context\GrantOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setRoleStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSetRoleStatement(Context\SetRoleStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setRoleStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSetRoleStatement(Context\SetRoleStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleList()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleList(Context\RoleListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleList()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleList(Context\RoleListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::role()}.
	 * @param $context The parse tree.
	 */
	public function enterRole(Context\RoleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::role()}.
	 * @param $context The parse tree.
	 */
	public function exitRole(Context\RoleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableAdministrationStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterTableAdministrationStatement(Context\TableAdministrationStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableAdministrationStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitTableAdministrationStatement(Context\TableAdministrationStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::histogramAutoUpdate()}.
	 * @param $context The parse tree.
	 */
	public function enterHistogramAutoUpdate(Context\HistogramAutoUpdateContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::histogramAutoUpdate()}.
	 * @param $context The parse tree.
	 */
	public function exitHistogramAutoUpdate(Context\HistogramAutoUpdateContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::histogramUpdateParam()}.
	 * @param $context The parse tree.
	 */
	public function enterHistogramUpdateParam(Context\HistogramUpdateParamContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::histogramUpdateParam()}.
	 * @param $context The parse tree.
	 */
	public function exitHistogramUpdateParam(Context\HistogramUpdateParamContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::histogramNumBuckets()}.
	 * @param $context The parse tree.
	 */
	public function enterHistogramNumBuckets(Context\HistogramNumBucketsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::histogramNumBuckets()}.
	 * @param $context The parse tree.
	 */
	public function exitHistogramNumBuckets(Context\HistogramNumBucketsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::histogram()}.
	 * @param $context The parse tree.
	 */
	public function enterHistogram(Context\HistogramContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::histogram()}.
	 * @param $context The parse tree.
	 */
	public function exitHistogram(Context\HistogramContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::checkOption()}.
	 * @param $context The parse tree.
	 */
	public function enterCheckOption(Context\CheckOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::checkOption()}.
	 * @param $context The parse tree.
	 */
	public function exitCheckOption(Context\CheckOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::repairType()}.
	 * @param $context The parse tree.
	 */
	public function enterRepairType(Context\RepairTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::repairType()}.
	 * @param $context The parse tree.
	 */
	public function exitRepairType(Context\RepairTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::uninstallStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterUninstallStatement(Context\UninstallStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::uninstallStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitUninstallStatement(Context\UninstallStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::installStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterInstallStatement(Context\InstallStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::installStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitInstallStatement(Context\InstallStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::installOptionType()}.
	 * @param $context The parse tree.
	 */
	public function enterInstallOptionType(Context\InstallOptionTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::installOptionType()}.
	 * @param $context The parse tree.
	 */
	public function exitInstallOptionType(Context\InstallOptionTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::installSetRvalue()}.
	 * @param $context The parse tree.
	 */
	public function enterInstallSetRvalue(Context\InstallSetRvalueContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::installSetRvalue()}.
	 * @param $context The parse tree.
	 */
	public function exitInstallSetRvalue(Context\InstallSetRvalueContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::installSetValue()}.
	 * @param $context The parse tree.
	 */
	public function enterInstallSetValue(Context\InstallSetValueContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::installSetValue()}.
	 * @param $context The parse tree.
	 */
	public function exitInstallSetValue(Context\InstallSetValueContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::installSetValueList()}.
	 * @param $context The parse tree.
	 */
	public function enterInstallSetValueList(Context\InstallSetValueListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::installSetValueList()}.
	 * @param $context The parse tree.
	 */
	public function exitInstallSetValueList(Context\InstallSetValueListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSetStatement(Context\SetStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSetStatement(Context\SetStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::startOptionValueList()}.
	 * @param $context The parse tree.
	 */
	public function enterStartOptionValueList(Context\StartOptionValueListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::startOptionValueList()}.
	 * @param $context The parse tree.
	 */
	public function exitStartOptionValueList(Context\StartOptionValueListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::transactionCharacteristics()}.
	 * @param $context The parse tree.
	 */
	public function enterTransactionCharacteristics(Context\TransactionCharacteristicsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::transactionCharacteristics()}.
	 * @param $context The parse tree.
	 */
	public function exitTransactionCharacteristics(Context\TransactionCharacteristicsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::transactionAccessMode()}.
	 * @param $context The parse tree.
	 */
	public function enterTransactionAccessMode(Context\TransactionAccessModeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::transactionAccessMode()}.
	 * @param $context The parse tree.
	 */
	public function exitTransactionAccessMode(Context\TransactionAccessModeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::isolationLevel()}.
	 * @param $context The parse tree.
	 */
	public function enterIsolationLevel(Context\IsolationLevelContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::isolationLevel()}.
	 * @param $context The parse tree.
	 */
	public function exitIsolationLevel(Context\IsolationLevelContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::optionValueListContinued()}.
	 * @param $context The parse tree.
	 */
	public function enterOptionValueListContinued(Context\OptionValueListContinuedContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::optionValueListContinued()}.
	 * @param $context The parse tree.
	 */
	public function exitOptionValueListContinued(Context\OptionValueListContinuedContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::optionValueNoOptionType()}.
	 * @param $context The parse tree.
	 */
	public function enterOptionValueNoOptionType(Context\OptionValueNoOptionTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::optionValueNoOptionType()}.
	 * @param $context The parse tree.
	 */
	public function exitOptionValueNoOptionType(Context\OptionValueNoOptionTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::optionValue()}.
	 * @param $context The parse tree.
	 */
	public function enterOptionValue(Context\OptionValueContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::optionValue()}.
	 * @param $context The parse tree.
	 */
	public function exitOptionValue(Context\OptionValueContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setSystemVariable()}.
	 * @param $context The parse tree.
	 */
	public function enterSetSystemVariable(Context\SetSystemVariableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setSystemVariable()}.
	 * @param $context The parse tree.
	 */
	public function exitSetSystemVariable(Context\SetSystemVariableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::startOptionValueListFollowingOptionType()}.
	 * @param $context The parse tree.
	 */
	public function enterStartOptionValueListFollowingOptionType(Context\StartOptionValueListFollowingOptionTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::startOptionValueListFollowingOptionType()}.
	 * @param $context The parse tree.
	 */
	public function exitStartOptionValueListFollowingOptionType(Context\StartOptionValueListFollowingOptionTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::optionValueFollowingOptionType()}.
	 * @param $context The parse tree.
	 */
	public function enterOptionValueFollowingOptionType(Context\OptionValueFollowingOptionTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::optionValueFollowingOptionType()}.
	 * @param $context The parse tree.
	 */
	public function exitOptionValueFollowingOptionType(Context\OptionValueFollowingOptionTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setExprOrDefault()}.
	 * @param $context The parse tree.
	 */
	public function enterSetExprOrDefault(Context\SetExprOrDefaultContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setExprOrDefault()}.
	 * @param $context The parse tree.
	 */
	public function exitSetExprOrDefault(Context\SetExprOrDefaultContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showDatabasesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowDatabasesStatement(Context\ShowDatabasesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showDatabasesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowDatabasesStatement(Context\ShowDatabasesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showTablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowTablesStatement(Context\ShowTablesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showTablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowTablesStatement(Context\ShowTablesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showTriggersStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowTriggersStatement(Context\ShowTriggersStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showTriggersStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowTriggersStatement(Context\ShowTriggersStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowEventsStatement(Context\ShowEventsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowEventsStatement(Context\ShowEventsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showTableStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowTableStatusStatement(Context\ShowTableStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showTableStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowTableStatusStatement(Context\ShowTableStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showOpenTablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowOpenTablesStatement(Context\ShowOpenTablesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showOpenTablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowOpenTablesStatement(Context\ShowOpenTablesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showParseTreeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowParseTreeStatement(Context\ShowParseTreeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showParseTreeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowParseTreeStatement(Context\ShowParseTreeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showPluginsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowPluginsStatement(Context\ShowPluginsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showPluginsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowPluginsStatement(Context\ShowPluginsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showEngineLogsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowEngineLogsStatement(Context\ShowEngineLogsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showEngineLogsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowEngineLogsStatement(Context\ShowEngineLogsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showEngineMutexStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowEngineMutexStatement(Context\ShowEngineMutexStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showEngineMutexStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowEngineMutexStatement(Context\ShowEngineMutexStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showEngineStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowEngineStatusStatement(Context\ShowEngineStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showEngineStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowEngineStatusStatement(Context\ShowEngineStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showColumnsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowColumnsStatement(Context\ShowColumnsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showColumnsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowColumnsStatement(Context\ShowColumnsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showBinaryLogsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowBinaryLogsStatement(Context\ShowBinaryLogsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showBinaryLogsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowBinaryLogsStatement(Context\ShowBinaryLogsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showBinaryLogStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowBinaryLogStatusStatement(Context\ShowBinaryLogStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showBinaryLogStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowBinaryLogStatusStatement(Context\ShowBinaryLogStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showReplicasStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowReplicasStatement(Context\ShowReplicasStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showReplicasStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowReplicasStatement(Context\ShowReplicasStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showBinlogEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowBinlogEventsStatement(Context\ShowBinlogEventsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showBinlogEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowBinlogEventsStatement(Context\ShowBinlogEventsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showRelaylogEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowRelaylogEventsStatement(Context\ShowRelaylogEventsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showRelaylogEventsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowRelaylogEventsStatement(Context\ShowRelaylogEventsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showKeysStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowKeysStatement(Context\ShowKeysStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showKeysStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowKeysStatement(Context\ShowKeysStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showEnginesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowEnginesStatement(Context\ShowEnginesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showEnginesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowEnginesStatement(Context\ShowEnginesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCountWarningsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCountWarningsStatement(Context\ShowCountWarningsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCountWarningsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCountWarningsStatement(Context\ShowCountWarningsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCountErrorsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCountErrorsStatement(Context\ShowCountErrorsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCountErrorsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCountErrorsStatement(Context\ShowCountErrorsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showWarningsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowWarningsStatement(Context\ShowWarningsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showWarningsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowWarningsStatement(Context\ShowWarningsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showErrorsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowErrorsStatement(Context\ShowErrorsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showErrorsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowErrorsStatement(Context\ShowErrorsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showProfilesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowProfilesStatement(Context\ShowProfilesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showProfilesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowProfilesStatement(Context\ShowProfilesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showProfileStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowProfileStatement(Context\ShowProfileStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showProfileStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowProfileStatement(Context\ShowProfileStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowStatusStatement(Context\ShowStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowStatusStatement(Context\ShowStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showProcessListStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowProcessListStatement(Context\ShowProcessListStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showProcessListStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowProcessListStatement(Context\ShowProcessListStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showVariablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowVariablesStatement(Context\ShowVariablesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showVariablesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowVariablesStatement(Context\ShowVariablesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCharacterSetStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCharacterSetStatement(Context\ShowCharacterSetStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCharacterSetStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCharacterSetStatement(Context\ShowCharacterSetStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCollationStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCollationStatement(Context\ShowCollationStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCollationStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCollationStatement(Context\ShowCollationStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showPrivilegesStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowPrivilegesStatement(Context\ShowPrivilegesStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showPrivilegesStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowPrivilegesStatement(Context\ShowPrivilegesStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showGrantsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowGrantsStatement(Context\ShowGrantsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showGrantsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowGrantsStatement(Context\ShowGrantsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateDatabaseStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateDatabaseStatement(Context\ShowCreateDatabaseStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateDatabaseStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateDatabaseStatement(Context\ShowCreateDatabaseStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateTableStatement(Context\ShowCreateTableStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateTableStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateTableStatement(Context\ShowCreateTableStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateViewStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateViewStatement(Context\ShowCreateViewStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateViewStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateViewStatement(Context\ShowCreateViewStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showMasterStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowMasterStatusStatement(Context\ShowMasterStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showMasterStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowMasterStatusStatement(Context\ShowMasterStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showReplicaStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowReplicaStatusStatement(Context\ShowReplicaStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showReplicaStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowReplicaStatusStatement(Context\ShowReplicaStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateProcedureStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateProcedureStatement(Context\ShowCreateProcedureStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateProcedureStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateProcedureStatement(Context\ShowCreateProcedureStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateFunctionStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateFunctionStatement(Context\ShowCreateFunctionStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateFunctionStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateFunctionStatement(Context\ShowCreateFunctionStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateTriggerStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateTriggerStatement(Context\ShowCreateTriggerStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateTriggerStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateTriggerStatement(Context\ShowCreateTriggerStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateProcedureStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateProcedureStatusStatement(Context\ShowCreateProcedureStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateProcedureStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateProcedureStatusStatement(Context\ShowCreateProcedureStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateFunctionStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateFunctionStatusStatement(Context\ShowCreateFunctionStatusStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateFunctionStatusStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateFunctionStatusStatement(Context\ShowCreateFunctionStatusStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateProcedureCodeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateProcedureCodeStatement(Context\ShowCreateProcedureCodeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateProcedureCodeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateProcedureCodeStatement(Context\ShowCreateProcedureCodeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateFunctionCodeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateFunctionCodeStatement(Context\ShowCreateFunctionCodeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateFunctionCodeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateFunctionCodeStatement(Context\ShowCreateFunctionCodeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateEventStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateEventStatement(Context\ShowCreateEventStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateEventStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateEventStatement(Context\ShowCreateEventStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCreateUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCreateUserStatement(Context\ShowCreateUserStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCreateUserStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCreateUserStatement(Context\ShowCreateUserStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::showCommandType()}.
	 * @param $context The parse tree.
	 */
	public function enterShowCommandType(Context\ShowCommandTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::showCommandType()}.
	 * @param $context The parse tree.
	 */
	public function exitShowCommandType(Context\ShowCommandTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::engineOrAll()}.
	 * @param $context The parse tree.
	 */
	public function enterEngineOrAll(Context\EngineOrAllContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::engineOrAll()}.
	 * @param $context The parse tree.
	 */
	public function exitEngineOrAll(Context\EngineOrAllContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fromOrIn()}.
	 * @param $context The parse tree.
	 */
	public function enterFromOrIn(Context\FromOrInContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fromOrIn()}.
	 * @param $context The parse tree.
	 */
	public function exitFromOrIn(Context\FromOrInContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::inDb()}.
	 * @param $context The parse tree.
	 */
	public function enterInDb(Context\InDbContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::inDb()}.
	 * @param $context The parse tree.
	 */
	public function exitInDb(Context\InDbContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::profileDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function enterProfileDefinitions(Context\ProfileDefinitionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::profileDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function exitProfileDefinitions(Context\ProfileDefinitionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::profileDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterProfileDefinition(Context\ProfileDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::profileDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitProfileDefinition(Context\ProfileDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::otherAdministrativeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterOtherAdministrativeStatement(Context\OtherAdministrativeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::otherAdministrativeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitOtherAdministrativeStatement(Context\OtherAdministrativeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyCacheListOrParts()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyCacheListOrParts(Context\KeyCacheListOrPartsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyCacheListOrParts()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyCacheListOrParts(Context\KeyCacheListOrPartsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyCacheList()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyCacheList(Context\KeyCacheListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyCacheList()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyCacheList(Context\KeyCacheListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::assignToKeycache()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignToKeycache(Context\AssignToKeycacheContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::assignToKeycache()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignToKeycache(Context\AssignToKeycacheContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::assignToKeycachePartition()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignToKeycachePartition(Context\AssignToKeycachePartitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::assignToKeycachePartition()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignToKeycachePartition(Context\AssignToKeycachePartitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cacheKeyList()}.
	 * @param $context The parse tree.
	 */
	public function enterCacheKeyList(Context\CacheKeyListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cacheKeyList()}.
	 * @param $context The parse tree.
	 */
	public function exitCacheKeyList(Context\CacheKeyListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyUsageElement()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyUsageElement(Context\KeyUsageElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyUsageElement()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyUsageElement(Context\KeyUsageElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyUsageList()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyUsageList(Context\KeyUsageListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyUsageList()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyUsageList(Context\KeyUsageListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::flushOption()}.
	 * @param $context The parse tree.
	 */
	public function enterFlushOption(Context\FlushOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::flushOption()}.
	 * @param $context The parse tree.
	 */
	public function exitFlushOption(Context\FlushOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::logType()}.
	 * @param $context The parse tree.
	 */
	public function enterLogType(Context\LogTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::logType()}.
	 * @param $context The parse tree.
	 */
	public function exitLogType(Context\LogTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::flushTables()}.
	 * @param $context The parse tree.
	 */
	public function enterFlushTables(Context\FlushTablesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::flushTables()}.
	 * @param $context The parse tree.
	 */
	public function exitFlushTables(Context\FlushTablesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::flushTablesOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterFlushTablesOptions(Context\FlushTablesOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::flushTablesOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitFlushTablesOptions(Context\FlushTablesOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::preloadTail()}.
	 * @param $context The parse tree.
	 */
	public function enterPreloadTail(Context\PreloadTailContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::preloadTail()}.
	 * @param $context The parse tree.
	 */
	public function exitPreloadTail(Context\PreloadTailContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::preloadList()}.
	 * @param $context The parse tree.
	 */
	public function enterPreloadList(Context\PreloadListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::preloadList()}.
	 * @param $context The parse tree.
	 */
	public function exitPreloadList(Context\PreloadListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::preloadKeys()}.
	 * @param $context The parse tree.
	 */
	public function enterPreloadKeys(Context\PreloadKeysContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::preloadKeys()}.
	 * @param $context The parse tree.
	 */
	public function exitPreloadKeys(Context\PreloadKeysContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::adminPartition()}.
	 * @param $context The parse tree.
	 */
	public function enterAdminPartition(Context\AdminPartitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::adminPartition()}.
	 * @param $context The parse tree.
	 */
	public function exitAdminPartition(Context\AdminPartitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resourceGroupManagement()}.
	 * @param $context The parse tree.
	 */
	public function enterResourceGroupManagement(Context\ResourceGroupManagementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resourceGroupManagement()}.
	 * @param $context The parse tree.
	 */
	public function exitResourceGroupManagement(Context\ResourceGroupManagementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateResourceGroup(Context\CreateResourceGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateResourceGroup(Context\CreateResourceGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resourceGroupVcpuList()}.
	 * @param $context The parse tree.
	 */
	public function enterResourceGroupVcpuList(Context\ResourceGroupVcpuListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resourceGroupVcpuList()}.
	 * @param $context The parse tree.
	 */
	public function exitResourceGroupVcpuList(Context\ResourceGroupVcpuListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::vcpuNumOrRange()}.
	 * @param $context The parse tree.
	 */
	public function enterVcpuNumOrRange(Context\VcpuNumOrRangeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::vcpuNumOrRange()}.
	 * @param $context The parse tree.
	 */
	public function exitVcpuNumOrRange(Context\VcpuNumOrRangeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resourceGroupPriority()}.
	 * @param $context The parse tree.
	 */
	public function enterResourceGroupPriority(Context\ResourceGroupPriorityContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resourceGroupPriority()}.
	 * @param $context The parse tree.
	 */
	public function exitResourceGroupPriority(Context\ResourceGroupPriorityContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resourceGroupEnableDisable()}.
	 * @param $context The parse tree.
	 */
	public function enterResourceGroupEnableDisable(Context\ResourceGroupEnableDisableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resourceGroupEnableDisable()}.
	 * @param $context The parse tree.
	 */
	public function exitResourceGroupEnableDisable(Context\ResourceGroupEnableDisableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::alterResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterAlterResourceGroup(Context\AlterResourceGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::alterResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitAlterResourceGroup(Context\AlterResourceGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterSetResourceGroup(Context\SetResourceGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitSetResourceGroup(Context\SetResourceGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::threadIdList()}.
	 * @param $context The parse tree.
	 */
	public function enterThreadIdList(Context\ThreadIdListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::threadIdList()}.
	 * @param $context The parse tree.
	 */
	public function exitThreadIdList(Context\ThreadIdListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dropResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function enterDropResourceGroup(Context\DropResourceGroupContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dropResourceGroup()}.
	 * @param $context The parse tree.
	 */
	public function exitDropResourceGroup(Context\DropResourceGroupContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::utilityStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterUtilityStatement(Context\UtilityStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::utilityStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitUtilityStatement(Context\UtilityStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::describeStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterDescribeStatement(Context\DescribeStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::describeStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitDescribeStatement(Context\DescribeStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::explainStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterExplainStatement(Context\ExplainStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::explainStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitExplainStatement(Context\ExplainStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::explainOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterExplainOptions(Context\ExplainOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::explainOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitExplainOptions(Context\ExplainOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::explainableStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterExplainableStatement(Context\ExplainableStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::explainableStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitExplainableStatement(Context\ExplainableStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::explainInto()}.
	 * @param $context The parse tree.
	 */
	public function enterExplainInto(Context\ExplainIntoContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::explainInto()}.
	 * @param $context The parse tree.
	 */
	public function exitExplainInto(Context\ExplainIntoContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::helpCommand()}.
	 * @param $context The parse tree.
	 */
	public function enterHelpCommand(Context\HelpCommandContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::helpCommand()}.
	 * @param $context The parse tree.
	 */
	public function exitHelpCommand(Context\HelpCommandContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::useCommand()}.
	 * @param $context The parse tree.
	 */
	public function enterUseCommand(Context\UseCommandContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::useCommand()}.
	 * @param $context The parse tree.
	 */
	public function exitUseCommand(Context\UseCommandContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::restartServer()}.
	 * @param $context The parse tree.
	 */
	public function enterRestartServer(Context\RestartServerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::restartServer()}.
	 * @param $context The parse tree.
	 */
	public function exitRestartServer(Context\RestartServerContext $context): void;
	/**
	 * Enter a parse tree produced by the `exprOr`
	 * labeled alternative in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function enterExprOr(Context\ExprOrContext $context): void;
	/**
	 * Exit a parse tree produced by the `exprOr` labeled alternative
	 * in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function exitExprOr(Context\ExprOrContext $context): void;
	/**
	 * Enter a parse tree produced by the `exprNot`
	 * labeled alternative in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function enterExprNot(Context\ExprNotContext $context): void;
	/**
	 * Exit a parse tree produced by the `exprNot` labeled alternative
	 * in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function exitExprNot(Context\ExprNotContext $context): void;
	/**
	 * Enter a parse tree produced by the `exprIs`
	 * labeled alternative in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function enterExprIs(Context\ExprIsContext $context): void;
	/**
	 * Exit a parse tree produced by the `exprIs` labeled alternative
	 * in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function exitExprIs(Context\ExprIsContext $context): void;
	/**
	 * Enter a parse tree produced by the `exprAnd`
	 * labeled alternative in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function enterExprAnd(Context\ExprAndContext $context): void;
	/**
	 * Exit a parse tree produced by the `exprAnd` labeled alternative
	 * in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function exitExprAnd(Context\ExprAndContext $context): void;
	/**
	 * Enter a parse tree produced by the `exprXor`
	 * labeled alternative in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function enterExprXor(Context\ExprXorContext $context): void;
	/**
	 * Exit a parse tree produced by the `exprXor` labeled alternative
	 * in {@see MySQLParser::expr()}.
	 * @param $context The parse tree.
	 */
	public function exitExprXor(Context\ExprXorContext $context): void;
	/**
	 * Enter a parse tree produced by the `primaryExprPredicate`
	 * labeled alternative in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimaryExprPredicate(Context\PrimaryExprPredicateContext $context): void;
	/**
	 * Exit a parse tree produced by the `primaryExprPredicate` labeled alternative
	 * in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimaryExprPredicate(Context\PrimaryExprPredicateContext $context): void;
	/**
	 * Enter a parse tree produced by the `primaryExprCompare`
	 * labeled alternative in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimaryExprCompare(Context\PrimaryExprCompareContext $context): void;
	/**
	 * Exit a parse tree produced by the `primaryExprCompare` labeled alternative
	 * in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimaryExprCompare(Context\PrimaryExprCompareContext $context): void;
	/**
	 * Enter a parse tree produced by the `primaryExprAllAny`
	 * labeled alternative in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimaryExprAllAny(Context\PrimaryExprAllAnyContext $context): void;
	/**
	 * Exit a parse tree produced by the `primaryExprAllAny` labeled alternative
	 * in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimaryExprAllAny(Context\PrimaryExprAllAnyContext $context): void;
	/**
	 * Enter a parse tree produced by the `primaryExprIsNull`
	 * labeled alternative in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimaryExprIsNull(Context\PrimaryExprIsNullContext $context): void;
	/**
	 * Exit a parse tree produced by the `primaryExprIsNull` labeled alternative
	 * in {@see MySQLParser::boolPri()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimaryExprIsNull(Context\PrimaryExprIsNullContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::compOp()}.
	 * @param $context The parse tree.
	 */
	public function enterCompOp(Context\CompOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::compOp()}.
	 * @param $context The parse tree.
	 */
	public function exitCompOp(Context\CompOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::predicate()}.
	 * @param $context The parse tree.
	 */
	public function enterPredicate(Context\PredicateContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::predicate()}.
	 * @param $context The parse tree.
	 */
	public function exitPredicate(Context\PredicateContext $context): void;
	/**
	 * Enter a parse tree produced by the `predicateExprIn`
	 * labeled alternative in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function enterPredicateExprIn(Context\PredicateExprInContext $context): void;
	/**
	 * Exit a parse tree produced by the `predicateExprIn` labeled alternative
	 * in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function exitPredicateExprIn(Context\PredicateExprInContext $context): void;
	/**
	 * Enter a parse tree produced by the `predicateExprBetween`
	 * labeled alternative in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function enterPredicateExprBetween(Context\PredicateExprBetweenContext $context): void;
	/**
	 * Exit a parse tree produced by the `predicateExprBetween` labeled alternative
	 * in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function exitPredicateExprBetween(Context\PredicateExprBetweenContext $context): void;
	/**
	 * Enter a parse tree produced by the `predicateExprLike`
	 * labeled alternative in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function enterPredicateExprLike(Context\PredicateExprLikeContext $context): void;
	/**
	 * Exit a parse tree produced by the `predicateExprLike` labeled alternative
	 * in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function exitPredicateExprLike(Context\PredicateExprLikeContext $context): void;
	/**
	 * Enter a parse tree produced by the `predicateExprRegex`
	 * labeled alternative in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function enterPredicateExprRegex(Context\PredicateExprRegexContext $context): void;
	/**
	 * Exit a parse tree produced by the `predicateExprRegex` labeled alternative
	 * in {@see MySQLParser::predicateOperations()}.
	 * @param $context The parse tree.
	 */
	public function exitPredicateExprRegex(Context\PredicateExprRegexContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::bitExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterBitExpr(Context\BitExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::bitExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitBitExpr(Context\BitExprContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprConvert`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprConvert(Context\SimpleExprConvertContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprConvert` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprConvert(Context\SimpleExprConvertContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprCast`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprCast(Context\SimpleExprCastContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprCast` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprCast(Context\SimpleExprCastContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprUnary`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprUnary(Context\SimpleExprUnaryContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprUnary` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprUnary(Context\SimpleExprUnaryContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExpressionRValue`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExpressionRValue(Context\SimpleExpressionRValueContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExpressionRValue` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExpressionRValue(Context\SimpleExpressionRValueContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprOdbc`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprOdbc(Context\SimpleExprOdbcContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprOdbc` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprOdbc(Context\SimpleExprOdbcContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprRuntimeFunction`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprRuntimeFunction(Context\SimpleExprRuntimeFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprRuntimeFunction` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprRuntimeFunction(Context\SimpleExprRuntimeFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprFunction`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprFunction(Context\SimpleExprFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprFunction` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprFunction(Context\SimpleExprFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprCollate`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprCollate(Context\SimpleExprCollateContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprCollate` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprCollate(Context\SimpleExprCollateContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprMatch`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprMatch(Context\SimpleExprMatchContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprMatch` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprMatch(Context\SimpleExprMatchContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprWindowingFunction`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprWindowingFunction(Context\SimpleExprWindowingFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprWindowingFunction` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprWindowingFunction(Context\SimpleExprWindowingFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprBinary`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprBinary(Context\SimpleExprBinaryContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprBinary` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprBinary(Context\SimpleExprBinaryContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprColumnRef`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprColumnRef(Context\SimpleExprColumnRefContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprColumnRef` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprColumnRef(Context\SimpleExprColumnRefContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprParamMarker`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprParamMarker(Context\SimpleExprParamMarkerContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprParamMarker` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprParamMarker(Context\SimpleExprParamMarkerContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprSum`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprSum(Context\SimpleExprSumContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprSum` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprSum(Context\SimpleExprSumContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprCastTime`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprCastTime(Context\SimpleExprCastTimeContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprCastTime` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprCastTime(Context\SimpleExprCastTimeContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprConvertUsing`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprConvertUsing(Context\SimpleExprConvertUsingContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprConvertUsing` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprConvertUsing(Context\SimpleExprConvertUsingContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprSubQuery`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprSubQuery(Context\SimpleExprSubQueryContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprSubQuery` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprSubQuery(Context\SimpleExprSubQueryContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprGroupingOperation`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprGroupingOperation(Context\SimpleExprGroupingOperationContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprGroupingOperation` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprGroupingOperation(Context\SimpleExprGroupingOperationContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprNot`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprNot(Context\SimpleExprNotContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprNot` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprNot(Context\SimpleExprNotContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprValues`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprValues(Context\SimpleExprValuesContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprValues` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprValues(Context\SimpleExprValuesContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprUserVariableAssignment`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprUserVariableAssignment(Context\SimpleExprUserVariableAssignmentContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprUserVariableAssignment` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprUserVariableAssignment(Context\SimpleExprUserVariableAssignmentContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprDefault`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprDefault(Context\SimpleExprDefaultContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprDefault` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprDefault(Context\SimpleExprDefaultContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprList`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprList(Context\SimpleExprListContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprList` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprList(Context\SimpleExprListContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprInterval`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprInterval(Context\SimpleExprIntervalContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprInterval` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprInterval(Context\SimpleExprIntervalContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprCase`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprCase(Context\SimpleExprCaseContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprCase` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprCase(Context\SimpleExprCaseContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprConcat`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprConcat(Context\SimpleExprConcatContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprConcat` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprConcat(Context\SimpleExprConcatContext $context): void;
	/**
	 * Enter a parse tree produced by the `simpleExprLiteral`
	 * labeled alternative in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprLiteral(Context\SimpleExprLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by the `simpleExprLiteral` labeled alternative
	 * in {@see MySQLParser::simpleExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprLiteral(Context\SimpleExprLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::arrayCast()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayCast(Context\ArrayCastContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::arrayCast()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayCast(Context\ArrayCastContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::jsonOperator()}.
	 * @param $context The parse tree.
	 */
	public function enterJsonOperator(Context\JsonOperatorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::jsonOperator()}.
	 * @param $context The parse tree.
	 */
	public function exitJsonOperator(Context\JsonOperatorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sumExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSumExpr(Context\SumExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sumExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSumExpr(Context\SumExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupingOperation()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupingOperation(Context\GroupingOperationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupingOperation()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupingOperation(Context\GroupingOperationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowFunctionCall()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowFunctionCall(Context\WindowFunctionCallContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowFunctionCall()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowFunctionCall(Context\WindowFunctionCallContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::samplingMethod()}.
	 * @param $context The parse tree.
	 */
	public function enterSamplingMethod(Context\SamplingMethodContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::samplingMethod()}.
	 * @param $context The parse tree.
	 */
	public function exitSamplingMethod(Context\SamplingMethodContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::samplingPercentage()}.
	 * @param $context The parse tree.
	 */
	public function enterSamplingPercentage(Context\SamplingPercentageContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::samplingPercentage()}.
	 * @param $context The parse tree.
	 */
	public function exitSamplingPercentage(Context\SamplingPercentageContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablesampleClause()}.
	 * @param $context The parse tree.
	 */
	public function enterTablesampleClause(Context\TablesampleClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablesampleClause()}.
	 * @param $context The parse tree.
	 */
	public function exitTablesampleClause(Context\TablesampleClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowingClause()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowingClause(Context\WindowingClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowingClause()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowingClause(Context\WindowingClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::leadLagInfo()}.
	 * @param $context The parse tree.
	 */
	public function enterLeadLagInfo(Context\LeadLagInfoContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::leadLagInfo()}.
	 * @param $context The parse tree.
	 */
	public function exitLeadLagInfo(Context\LeadLagInfoContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::stableInteger()}.
	 * @param $context The parse tree.
	 */
	public function enterStableInteger(Context\StableIntegerContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::stableInteger()}.
	 * @param $context The parse tree.
	 */
	public function exitStableInteger(Context\StableIntegerContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::paramOrVar()}.
	 * @param $context The parse tree.
	 */
	public function enterParamOrVar(Context\ParamOrVarContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::paramOrVar()}.
	 * @param $context The parse tree.
	 */
	public function exitParamOrVar(Context\ParamOrVarContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::nullTreatment()}.
	 * @param $context The parse tree.
	 */
	public function enterNullTreatment(Context\NullTreatmentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::nullTreatment()}.
	 * @param $context The parse tree.
	 */
	public function exitNullTreatment(Context\NullTreatmentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::jsonFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterJsonFunction(Context\JsonFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::jsonFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitJsonFunction(Context\JsonFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::inSumExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterInSumExpr(Context\InSumExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::inSumExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitInSumExpr(Context\InSumExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identListArg()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentListArg(Context\IdentListArgContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identListArg()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentListArg(Context\IdentListArgContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identList()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentList(Context\IdentListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identList()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentList(Context\IdentListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fulltextOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterFulltextOptions(Context\FulltextOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fulltextOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitFulltextOptions(Context\FulltextOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::runtimeFunctionCall()}.
	 * @param $context The parse tree.
	 */
	public function enterRuntimeFunctionCall(Context\RuntimeFunctionCallContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::runtimeFunctionCall()}.
	 * @param $context The parse tree.
	 */
	public function exitRuntimeFunctionCall(Context\RuntimeFunctionCallContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::returningType()}.
	 * @param $context The parse tree.
	 */
	public function enterReturningType(Context\ReturningTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::returningType()}.
	 * @param $context The parse tree.
	 */
	public function exitReturningType(Context\ReturningTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::geometryFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterGeometryFunction(Context\GeometryFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::geometryFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitGeometryFunction(Context\GeometryFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::timeFunctionParameters()}.
	 * @param $context The parse tree.
	 */
	public function enterTimeFunctionParameters(Context\TimeFunctionParametersContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::timeFunctionParameters()}.
	 * @param $context The parse tree.
	 */
	public function exitTimeFunctionParameters(Context\TimeFunctionParametersContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fractionalPrecision()}.
	 * @param $context The parse tree.
	 */
	public function enterFractionalPrecision(Context\FractionalPrecisionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fractionalPrecision()}.
	 * @param $context The parse tree.
	 */
	public function exitFractionalPrecision(Context\FractionalPrecisionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::weightStringLevels()}.
	 * @param $context The parse tree.
	 */
	public function enterWeightStringLevels(Context\WeightStringLevelsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::weightStringLevels()}.
	 * @param $context The parse tree.
	 */
	public function exitWeightStringLevels(Context\WeightStringLevelsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::weightStringLevelListItem()}.
	 * @param $context The parse tree.
	 */
	public function enterWeightStringLevelListItem(Context\WeightStringLevelListItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::weightStringLevelListItem()}.
	 * @param $context The parse tree.
	 */
	public function exitWeightStringLevelListItem(Context\WeightStringLevelListItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dateTimeTtype()}.
	 * @param $context The parse tree.
	 */
	public function enterDateTimeTtype(Context\DateTimeTtypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dateTimeTtype()}.
	 * @param $context The parse tree.
	 */
	public function exitDateTimeTtype(Context\DateTimeTtypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::trimFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterTrimFunction(Context\TrimFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::trimFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitTrimFunction(Context\TrimFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::substringFunction()}.
	 * @param $context The parse tree.
	 */
	public function enterSubstringFunction(Context\SubstringFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::substringFunction()}.
	 * @param $context The parse tree.
	 */
	public function exitSubstringFunction(Context\SubstringFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::functionCall()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionCall(Context\FunctionCallContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::functionCall()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionCall(Context\FunctionCallContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::udfExprList()}.
	 * @param $context The parse tree.
	 */
	public function enterUdfExprList(Context\UdfExprListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::udfExprList()}.
	 * @param $context The parse tree.
	 */
	public function exitUdfExprList(Context\UdfExprListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::udfExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterUdfExpr(Context\UdfExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::udfExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitUdfExpr(Context\UdfExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userVariable()}.
	 * @param $context The parse tree.
	 */
	public function enterUserVariable(Context\UserVariableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userVariable()}.
	 * @param $context The parse tree.
	 */
	public function exitUserVariable(Context\UserVariableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::inExpressionUserVariableAssignment()}.
	 * @param $context The parse tree.
	 */
	public function enterInExpressionUserVariableAssignment(Context\InExpressionUserVariableAssignmentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::inExpressionUserVariableAssignment()}.
	 * @param $context The parse tree.
	 */
	public function exitInExpressionUserVariableAssignment(Context\InExpressionUserVariableAssignmentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::rvalueSystemOrUserVariable()}.
	 * @param $context The parse tree.
	 */
	public function enterRvalueSystemOrUserVariable(Context\RvalueSystemOrUserVariableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::rvalueSystemOrUserVariable()}.
	 * @param $context The parse tree.
	 */
	public function exitRvalueSystemOrUserVariable(Context\RvalueSystemOrUserVariableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lvalueVariable()}.
	 * @param $context The parse tree.
	 */
	public function enterLvalueVariable(Context\LvalueVariableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lvalueVariable()}.
	 * @param $context The parse tree.
	 */
	public function exitLvalueVariable(Context\LvalueVariableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::rvalueSystemVariable()}.
	 * @param $context The parse tree.
	 */
	public function enterRvalueSystemVariable(Context\RvalueSystemVariableContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::rvalueSystemVariable()}.
	 * @param $context The parse tree.
	 */
	public function exitRvalueSystemVariable(Context\RvalueSystemVariableContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::whenExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterWhenExpression(Context\WhenExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::whenExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitWhenExpression(Context\WhenExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::thenExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterThenExpression(Context\ThenExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::thenExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitThenExpression(Context\ThenExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::elseExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterElseExpression(Context\ElseExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::elseExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitElseExpression(Context\ElseExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::castType()}.
	 * @param $context The parse tree.
	 */
	public function enterCastType(Context\CastTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::castType()}.
	 * @param $context The parse tree.
	 */
	public function exitCastType(Context\CastTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::exprList()}.
	 * @param $context The parse tree.
	 */
	public function enterExprList(Context\ExprListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::exprList()}.
	 * @param $context The parse tree.
	 */
	public function exitExprList(Context\ExprListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::charset()}.
	 * @param $context The parse tree.
	 */
	public function enterCharset(Context\CharsetContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::charset()}.
	 * @param $context The parse tree.
	 */
	public function exitCharset(Context\CharsetContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::notRule()}.
	 * @param $context The parse tree.
	 */
	public function enterNotRule(Context\NotRuleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::notRule()}.
	 * @param $context The parse tree.
	 */
	public function exitNotRule(Context\NotRuleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::not2Rule()}.
	 * @param $context The parse tree.
	 */
	public function enterNot2Rule(Context\Not2RuleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::not2Rule()}.
	 * @param $context The parse tree.
	 */
	public function exitNot2Rule(Context\Not2RuleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::interval()}.
	 * @param $context The parse tree.
	 */
	public function enterInterval(Context\IntervalContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::interval()}.
	 * @param $context The parse tree.
	 */
	public function exitInterval(Context\IntervalContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::intervalTimeStamp()}.
	 * @param $context The parse tree.
	 */
	public function enterIntervalTimeStamp(Context\IntervalTimeStampContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::intervalTimeStamp()}.
	 * @param $context The parse tree.
	 */
	public function exitIntervalTimeStamp(Context\IntervalTimeStampContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::exprListWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function enterExprListWithParentheses(Context\ExprListWithParenthesesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::exprListWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function exitExprListWithParentheses(Context\ExprListWithParenthesesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::exprWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function enterExprWithParentheses(Context\ExprWithParenthesesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::exprWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function exitExprWithParentheses(Context\ExprWithParenthesesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::simpleExprWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleExprWithParentheses(Context\SimpleExprWithParenthesesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::simpleExprWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleExprWithParentheses(Context\SimpleExprWithParenthesesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::orderList()}.
	 * @param $context The parse tree.
	 */
	public function enterOrderList(Context\OrderListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::orderList()}.
	 * @param $context The parse tree.
	 */
	public function exitOrderList(Context\OrderListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::orderExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterOrderExpression(Context\OrderExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::orderExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitOrderExpression(Context\OrderExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupList()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupList(Context\GroupListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupList()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupList(Context\GroupListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::groupingExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterGroupingExpression(Context\GroupingExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::groupingExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitGroupingExpression(Context\GroupingExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::channel()}.
	 * @param $context The parse tree.
	 */
	public function enterChannel(Context\ChannelContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::channel()}.
	 * @param $context The parse tree.
	 */
	public function exitChannel(Context\ChannelContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::compoundStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCompoundStatement(Context\CompoundStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::compoundStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCompoundStatement(Context\CompoundStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::returnStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnStatement(Context\ReturnStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::returnStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnStatement(Context\ReturnStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ifStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterIfStatement(Context\IfStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ifStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitIfStatement(Context\IfStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ifBody()}.
	 * @param $context The parse tree.
	 */
	public function enterIfBody(Context\IfBodyContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ifBody()}.
	 * @param $context The parse tree.
	 */
	public function exitIfBody(Context\IfBodyContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::thenStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterThenStatement(Context\ThenStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::thenStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitThenStatement(Context\ThenStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::compoundStatementList()}.
	 * @param $context The parse tree.
	 */
	public function enterCompoundStatementList(Context\CompoundStatementListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::compoundStatementList()}.
	 * @param $context The parse tree.
	 */
	public function exitCompoundStatementList(Context\CompoundStatementListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::caseStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterCaseStatement(Context\CaseStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::caseStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitCaseStatement(Context\CaseStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::elseStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterElseStatement(Context\ElseStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::elseStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitElseStatement(Context\ElseStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::labeledBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterLabeledBlock(Context\LabeledBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::labeledBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitLabeledBlock(Context\LabeledBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::unlabeledBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterUnlabeledBlock(Context\UnlabeledBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::unlabeledBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitUnlabeledBlock(Context\UnlabeledBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::label()}.
	 * @param $context The parse tree.
	 */
	public function enterLabel(Context\LabelContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::label()}.
	 * @param $context The parse tree.
	 */
	public function exitLabel(Context\LabelContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::beginEndBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterBeginEndBlock(Context\BeginEndBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::beginEndBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitBeginEndBlock(Context\BeginEndBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::labeledControl()}.
	 * @param $context The parse tree.
	 */
	public function enterLabeledControl(Context\LabeledControlContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::labeledControl()}.
	 * @param $context The parse tree.
	 */
	public function exitLabeledControl(Context\LabeledControlContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::unlabeledControl()}.
	 * @param $context The parse tree.
	 */
	public function enterUnlabeledControl(Context\UnlabeledControlContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::unlabeledControl()}.
	 * @param $context The parse tree.
	 */
	public function exitUnlabeledControl(Context\UnlabeledControlContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::loopBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterLoopBlock(Context\LoopBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::loopBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitLoopBlock(Context\LoopBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::whileDoBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterWhileDoBlock(Context\WhileDoBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::whileDoBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitWhileDoBlock(Context\WhileDoBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::repeatUntilBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterRepeatUntilBlock(Context\RepeatUntilBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::repeatUntilBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitRepeatUntilBlock(Context\RepeatUntilBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::spDeclarations()}.
	 * @param $context The parse tree.
	 */
	public function enterSpDeclarations(Context\SpDeclarationsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::spDeclarations()}.
	 * @param $context The parse tree.
	 */
	public function exitSpDeclarations(Context\SpDeclarationsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::spDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function enterSpDeclaration(Context\SpDeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::spDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function exitSpDeclaration(Context\SpDeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::variableDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function enterVariableDeclaration(Context\VariableDeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::variableDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function exitVariableDeclaration(Context\VariableDeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::conditionDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function enterConditionDeclaration(Context\ConditionDeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::conditionDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function exitConditionDeclaration(Context\ConditionDeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::spCondition()}.
	 * @param $context The parse tree.
	 */
	public function enterSpCondition(Context\SpConditionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::spCondition()}.
	 * @param $context The parse tree.
	 */
	public function exitSpCondition(Context\SpConditionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sqlstate()}.
	 * @param $context The parse tree.
	 */
	public function enterSqlstate(Context\SqlstateContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sqlstate()}.
	 * @param $context The parse tree.
	 */
	public function exitSqlstate(Context\SqlstateContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::handlerDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function enterHandlerDeclaration(Context\HandlerDeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::handlerDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function exitHandlerDeclaration(Context\HandlerDeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::handlerCondition()}.
	 * @param $context The parse tree.
	 */
	public function enterHandlerCondition(Context\HandlerConditionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::handlerCondition()}.
	 * @param $context The parse tree.
	 */
	public function exitHandlerCondition(Context\HandlerConditionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cursorDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function enterCursorDeclaration(Context\CursorDeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cursorDeclaration()}.
	 * @param $context The parse tree.
	 */
	public function exitCursorDeclaration(Context\CursorDeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::iterateStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterIterateStatement(Context\IterateStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::iterateStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitIterateStatement(Context\IterateStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::leaveStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterLeaveStatement(Context\LeaveStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::leaveStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitLeaveStatement(Context\LeaveStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::getDiagnosticsStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterGetDiagnosticsStatement(Context\GetDiagnosticsStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::getDiagnosticsStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitGetDiagnosticsStatement(Context\GetDiagnosticsStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signalAllowedExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterSignalAllowedExpr(Context\SignalAllowedExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signalAllowedExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitSignalAllowedExpr(Context\SignalAllowedExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::statementInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function enterStatementInformationItem(Context\StatementInformationItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::statementInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function exitStatementInformationItem(Context\StatementInformationItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::conditionInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function enterConditionInformationItem(Context\ConditionInformationItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::conditionInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function exitConditionInformationItem(Context\ConditionInformationItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signalInformationItemName()}.
	 * @param $context The parse tree.
	 */
	public function enterSignalInformationItemName(Context\SignalInformationItemNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signalInformationItemName()}.
	 * @param $context The parse tree.
	 */
	public function exitSignalInformationItemName(Context\SignalInformationItemNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signalStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterSignalStatement(Context\SignalStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signalStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitSignalStatement(Context\SignalStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resignalStatement()}.
	 * @param $context The parse tree.
	 */
	public function enterResignalStatement(Context\ResignalStatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resignalStatement()}.
	 * @param $context The parse tree.
	 */
	public function exitResignalStatement(Context\ResignalStatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signalInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function enterSignalInformationItem(Context\SignalInformationItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signalInformationItem()}.
	 * @param $context The parse tree.
	 */
	public function exitSignalInformationItem(Context\SignalInformationItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cursorOpen()}.
	 * @param $context The parse tree.
	 */
	public function enterCursorOpen(Context\CursorOpenContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cursorOpen()}.
	 * @param $context The parse tree.
	 */
	public function exitCursorOpen(Context\CursorOpenContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cursorClose()}.
	 * @param $context The parse tree.
	 */
	public function enterCursorClose(Context\CursorCloseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cursorClose()}.
	 * @param $context The parse tree.
	 */
	public function exitCursorClose(Context\CursorCloseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::cursorFetch()}.
	 * @param $context The parse tree.
	 */
	public function enterCursorFetch(Context\CursorFetchContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::cursorFetch()}.
	 * @param $context The parse tree.
	 */
	public function exitCursorFetch(Context\CursorFetchContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::schedule()}.
	 * @param $context The parse tree.
	 */
	public function enterSchedule(Context\ScheduleContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::schedule()}.
	 * @param $context The parse tree.
	 */
	public function exitSchedule(Context\ScheduleContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnDefinition(Context\ColumnDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnDefinition(Context\ColumnDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::checkOrReferences()}.
	 * @param $context The parse tree.
	 */
	public function enterCheckOrReferences(Context\CheckOrReferencesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::checkOrReferences()}.
	 * @param $context The parse tree.
	 */
	public function exitCheckOrReferences(Context\CheckOrReferencesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::checkConstraint()}.
	 * @param $context The parse tree.
	 */
	public function enterCheckConstraint(Context\CheckConstraintContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::checkConstraint()}.
	 * @param $context The parse tree.
	 */
	public function exitCheckConstraint(Context\CheckConstraintContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::constraintEnforcement()}.
	 * @param $context The parse tree.
	 */
	public function enterConstraintEnforcement(Context\ConstraintEnforcementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::constraintEnforcement()}.
	 * @param $context The parse tree.
	 */
	public function exitConstraintEnforcement(Context\ConstraintEnforcementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableConstraintDef()}.
	 * @param $context The parse tree.
	 */
	public function enterTableConstraintDef(Context\TableConstraintDefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableConstraintDef()}.
	 * @param $context The parse tree.
	 */
	public function exitTableConstraintDef(Context\TableConstraintDefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::constraintName()}.
	 * @param $context The parse tree.
	 */
	public function enterConstraintName(Context\ConstraintNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::constraintName()}.
	 * @param $context The parse tree.
	 */
	public function exitConstraintName(Context\ConstraintNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldDefinition(Context\FieldDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldDefinition(Context\FieldDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnAttribute(Context\ColumnAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnAttribute(Context\ColumnAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnFormat()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnFormat(Context\ColumnFormatContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnFormat()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnFormat(Context\ColumnFormatContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::storageMedia()}.
	 * @param $context The parse tree.
	 */
	public function enterStorageMedia(Context\StorageMediaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::storageMedia()}.
	 * @param $context The parse tree.
	 */
	public function exitStorageMedia(Context\StorageMediaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::now()}.
	 * @param $context The parse tree.
	 */
	public function enterNow(Context\NowContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::now()}.
	 * @param $context The parse tree.
	 */
	public function exitNow(Context\NowContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::nowOrSignedLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterNowOrSignedLiteral(Context\NowOrSignedLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::nowOrSignedLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitNowOrSignedLiteral(Context\NowOrSignedLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::gcolAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterGcolAttribute(Context\GcolAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::gcolAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitGcolAttribute(Context\GcolAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::references()}.
	 * @param $context The parse tree.
	 */
	public function enterReferences(Context\ReferencesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::references()}.
	 * @param $context The parse tree.
	 */
	public function exitReferences(Context\ReferencesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::deleteOption()}.
	 * @param $context The parse tree.
	 */
	public function enterDeleteOption(Context\DeleteOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::deleteOption()}.
	 * @param $context The parse tree.
	 */
	public function exitDeleteOption(Context\DeleteOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyList()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyList(Context\KeyListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyList()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyList(Context\KeyListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyPart()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyPart(Context\KeyPartContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyPart()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyPart(Context\KeyPartContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyListWithExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyListWithExpression(Context\KeyListWithExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyListWithExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyListWithExpression(Context\KeyListWithExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::keyPartOrExpression()}.
	 * @param $context The parse tree.
	 */
	public function enterKeyPartOrExpression(Context\KeyPartOrExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::keyPartOrExpression()}.
	 * @param $context The parse tree.
	 */
	public function exitKeyPartOrExpression(Context\KeyPartOrExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexType()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexType(Context\IndexTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexType()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexType(Context\IndexTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexOption()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexOption(Context\IndexOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexOption()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexOption(Context\IndexOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::commonIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function enterCommonIndexOption(Context\CommonIndexOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::commonIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function exitCommonIndexOption(Context\CommonIndexOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::visibility()}.
	 * @param $context The parse tree.
	 */
	public function enterVisibility(Context\VisibilityContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::visibility()}.
	 * @param $context The parse tree.
	 */
	public function exitVisibility(Context\VisibilityContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexTypeClause()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexTypeClause(Context\IndexTypeClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexTypeClause()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexTypeClause(Context\IndexTypeClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fulltextIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function enterFulltextIndexOption(Context\FulltextIndexOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fulltextIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function exitFulltextIndexOption(Context\FulltextIndexOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::spatialIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function enterSpatialIndexOption(Context\SpatialIndexOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::spatialIndexOption()}.
	 * @param $context The parse tree.
	 */
	public function exitSpatialIndexOption(Context\SpatialIndexOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dataTypeDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterDataTypeDefinition(Context\DataTypeDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dataTypeDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitDataTypeDefinition(Context\DataTypeDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dataType()}.
	 * @param $context The parse tree.
	 */
	public function enterDataType(Context\DataTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dataType()}.
	 * @param $context The parse tree.
	 */
	public function exitDataType(Context\DataTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::nchar()}.
	 * @param $context The parse tree.
	 */
	public function enterNchar(Context\NcharContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::nchar()}.
	 * @param $context The parse tree.
	 */
	public function exitNchar(Context\NcharContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::realType()}.
	 * @param $context The parse tree.
	 */
	public function enterRealType(Context\RealTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::realType()}.
	 * @param $context The parse tree.
	 */
	public function exitRealType(Context\RealTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldLength()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldLength(Context\FieldLengthContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldLength()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldLength(Context\FieldLengthContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldOptions(Context\FieldOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldOptions(Context\FieldOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::charsetWithOptBinary()}.
	 * @param $context The parse tree.
	 */
	public function enterCharsetWithOptBinary(Context\CharsetWithOptBinaryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::charsetWithOptBinary()}.
	 * @param $context The parse tree.
	 */
	public function exitCharsetWithOptBinary(Context\CharsetWithOptBinaryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ascii()}.
	 * @param $context The parse tree.
	 */
	public function enterAscii(Context\AsciiContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ascii()}.
	 * @param $context The parse tree.
	 */
	public function exitAscii(Context\AsciiContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::unicode()}.
	 * @param $context The parse tree.
	 */
	public function enterUnicode(Context\UnicodeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::unicode()}.
	 * @param $context The parse tree.
	 */
	public function exitUnicode(Context\UnicodeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::wsNumCodepoints()}.
	 * @param $context The parse tree.
	 */
	public function enterWsNumCodepoints(Context\WsNumCodepointsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::wsNumCodepoints()}.
	 * @param $context The parse tree.
	 */
	public function exitWsNumCodepoints(Context\WsNumCodepointsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::typeDatetimePrecision()}.
	 * @param $context The parse tree.
	 */
	public function enterTypeDatetimePrecision(Context\TypeDatetimePrecisionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::typeDatetimePrecision()}.
	 * @param $context The parse tree.
	 */
	public function exitTypeDatetimePrecision(Context\TypeDatetimePrecisionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::functionDatetimePrecision()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionDatetimePrecision(Context\FunctionDatetimePrecisionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::functionDatetimePrecision()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionDatetimePrecision(Context\FunctionDatetimePrecisionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::charsetName()}.
	 * @param $context The parse tree.
	 */
	public function enterCharsetName(Context\CharsetNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::charsetName()}.
	 * @param $context The parse tree.
	 */
	public function exitCharsetName(Context\CharsetNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::collationName()}.
	 * @param $context The parse tree.
	 */
	public function enterCollationName(Context\CollationNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::collationName()}.
	 * @param $context The parse tree.
	 */
	public function exitCollationName(Context\CollationNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTableOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTableOptions(Context\CreateTableOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTableOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTableOptions(Context\CreateTableOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTableOptionsEtc()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTableOptionsEtc(Context\CreateTableOptionsEtcContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTableOptionsEtc()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTableOptionsEtc(Context\CreateTableOptionsEtcContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createPartitioningEtc()}.
	 * @param $context The parse tree.
	 */
	public function enterCreatePartitioningEtc(Context\CreatePartitioningEtcContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createPartitioningEtc()}.
	 * @param $context The parse tree.
	 */
	public function exitCreatePartitioningEtc(Context\CreatePartitioningEtcContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTableOptionsSpaceSeparated()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTableOptionsSpaceSeparated(Context\CreateTableOptionsSpaceSeparatedContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTableOptionsSpaceSeparated()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTableOptionsSpaceSeparated(Context\CreateTableOptionsSpaceSeparatedContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createTableOption()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateTableOption(Context\CreateTableOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createTableOption()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateTableOption(Context\CreateTableOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ternaryOption()}.
	 * @param $context The parse tree.
	 */
	public function enterTernaryOption(Context\TernaryOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ternaryOption()}.
	 * @param $context The parse tree.
	 */
	public function exitTernaryOption(Context\TernaryOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::defaultCollation()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultCollation(Context\DefaultCollationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::defaultCollation()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultCollation(Context\DefaultCollationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::defaultEncryption()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultEncryption(Context\DefaultEncryptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::defaultEncryption()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultEncryption(Context\DefaultEncryptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::defaultCharset()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultCharset(Context\DefaultCharsetContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::defaultCharset()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultCharset(Context\DefaultCharsetContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionClause()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionClause(Context\PartitionClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionClause()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionClause(Context\PartitionClauseContext $context): void;
	/**
	 * Enter a parse tree produced by the `partitionDefKey`
	 * labeled alternative in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDefKey(Context\PartitionDefKeyContext $context): void;
	/**
	 * Exit a parse tree produced by the `partitionDefKey` labeled alternative
	 * in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDefKey(Context\PartitionDefKeyContext $context): void;
	/**
	 * Enter a parse tree produced by the `partitionDefHash`
	 * labeled alternative in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDefHash(Context\PartitionDefHashContext $context): void;
	/**
	 * Exit a parse tree produced by the `partitionDefHash` labeled alternative
	 * in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDefHash(Context\PartitionDefHashContext $context): void;
	/**
	 * Enter a parse tree produced by the `partitionDefRangeList`
	 * labeled alternative in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDefRangeList(Context\PartitionDefRangeListContext $context): void;
	/**
	 * Exit a parse tree produced by the `partitionDefRangeList` labeled alternative
	 * in {@see MySQLParser::partitionTypeDef()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDefRangeList(Context\PartitionDefRangeListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::subPartitions()}.
	 * @param $context The parse tree.
	 */
	public function enterSubPartitions(Context\SubPartitionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::subPartitions()}.
	 * @param $context The parse tree.
	 */
	public function exitSubPartitions(Context\SubPartitionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionKeyAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionKeyAlgorithm(Context\PartitionKeyAlgorithmContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionKeyAlgorithm()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionKeyAlgorithm(Context\PartitionKeyAlgorithmContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDefinitions(Context\PartitionDefinitionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionDefinitions()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDefinitions(Context\PartitionDefinitionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionDefinition(Context\PartitionDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionDefinition(Context\PartitionDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionValuesIn()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionValuesIn(Context\PartitionValuesInContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionValuesIn()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionValuesIn(Context\PartitionValuesInContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionOption()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionOption(Context\PartitionOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionOption()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionOption(Context\PartitionOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::subpartitionDefinition()}.
	 * @param $context The parse tree.
	 */
	public function enterSubpartitionDefinition(Context\SubpartitionDefinitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::subpartitionDefinition()}.
	 * @param $context The parse tree.
	 */
	public function exitSubpartitionDefinition(Context\SubpartitionDefinitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionValueItemListParen()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionValueItemListParen(Context\PartitionValueItemListParenContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionValueItemListParen()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionValueItemListParen(Context\PartitionValueItemListParenContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::partitionValueItem()}.
	 * @param $context The parse tree.
	 */
	public function enterPartitionValueItem(Context\PartitionValueItemContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::partitionValueItem()}.
	 * @param $context The parse tree.
	 */
	public function exitPartitionValueItem(Context\PartitionValueItemContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::definerClause()}.
	 * @param $context The parse tree.
	 */
	public function enterDefinerClause(Context\DefinerClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::definerClause()}.
	 * @param $context The parse tree.
	 */
	public function exitDefinerClause(Context\DefinerClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ifExists()}.
	 * @param $context The parse tree.
	 */
	public function enterIfExists(Context\IfExistsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ifExists()}.
	 * @param $context The parse tree.
	 */
	public function exitIfExists(Context\IfExistsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ifExistsIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterIfExistsIdentifier(Context\IfExistsIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ifExistsIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitIfExistsIdentifier(Context\IfExistsIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::persistedVariableIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterPersistedVariableIdentifier(Context\PersistedVariableIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::persistedVariableIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitPersistedVariableIdentifier(Context\PersistedVariableIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ifNotExists()}.
	 * @param $context The parse tree.
	 */
	public function enterIfNotExists(Context\IfNotExistsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ifNotExists()}.
	 * @param $context The parse tree.
	 */
	public function exitIfNotExists(Context\IfNotExistsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ignoreUnknownUser()}.
	 * @param $context The parse tree.
	 */
	public function enterIgnoreUnknownUser(Context\IgnoreUnknownUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ignoreUnknownUser()}.
	 * @param $context The parse tree.
	 */
	public function exitIgnoreUnknownUser(Context\IgnoreUnknownUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::procedureParameter()}.
	 * @param $context The parse tree.
	 */
	public function enterProcedureParameter(Context\ProcedureParameterContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::procedureParameter()}.
	 * @param $context The parse tree.
	 */
	public function exitProcedureParameter(Context\ProcedureParameterContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::functionParameter()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionParameter(Context\FunctionParameterContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::functionParameter()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionParameter(Context\FunctionParameterContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::collate()}.
	 * @param $context The parse tree.
	 */
	public function enterCollate(Context\CollateContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::collate()}.
	 * @param $context The parse tree.
	 */
	public function exitCollate(Context\CollateContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::typeWithOptCollate()}.
	 * @param $context The parse tree.
	 */
	public function enterTypeWithOptCollate(Context\TypeWithOptCollateContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::typeWithOptCollate()}.
	 * @param $context The parse tree.
	 */
	public function exitTypeWithOptCollate(Context\TypeWithOptCollateContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::schemaIdentifierPair()}.
	 * @param $context The parse tree.
	 */
	public function enterSchemaIdentifierPair(Context\SchemaIdentifierPairContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::schemaIdentifierPair()}.
	 * @param $context The parse tree.
	 */
	public function exitSchemaIdentifierPair(Context\SchemaIdentifierPairContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewRefList()}.
	 * @param $context The parse tree.
	 */
	public function enterViewRefList(Context\ViewRefListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewRefList()}.
	 * @param $context The parse tree.
	 */
	public function exitViewRefList(Context\ViewRefListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::updateList()}.
	 * @param $context The parse tree.
	 */
	public function enterUpdateList(Context\UpdateListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::updateList()}.
	 * @param $context The parse tree.
	 */
	public function exitUpdateList(Context\UpdateListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::updateElement()}.
	 * @param $context The parse tree.
	 */
	public function enterUpdateElement(Context\UpdateElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::updateElement()}.
	 * @param $context The parse tree.
	 */
	public function exitUpdateElement(Context\UpdateElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::charsetClause()}.
	 * @param $context The parse tree.
	 */
	public function enterCharsetClause(Context\CharsetClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::charsetClause()}.
	 * @param $context The parse tree.
	 */
	public function exitCharsetClause(Context\CharsetClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldsClause()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldsClause(Context\FieldsClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldsClause()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldsClause(Context\FieldsClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldTerm()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldTerm(Context\FieldTermContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldTerm()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldTerm(Context\FieldTermContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::linesClause()}.
	 * @param $context The parse tree.
	 */
	public function enterLinesClause(Context\LinesClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::linesClause()}.
	 * @param $context The parse tree.
	 */
	public function exitLinesClause(Context\LinesClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lineTerm()}.
	 * @param $context The parse tree.
	 */
	public function enterLineTerm(Context\LineTermContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lineTerm()}.
	 * @param $context The parse tree.
	 */
	public function exitLineTerm(Context\LineTermContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userList()}.
	 * @param $context The parse tree.
	 */
	public function enterUserList(Context\UserListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userList()}.
	 * @param $context The parse tree.
	 */
	public function exitUserList(Context\UserListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUserList()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUserList(Context\CreateUserListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUserList()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUserList(Context\CreateUserListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUser()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUser(Context\CreateUserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUser()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUser(Context\CreateUserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::createUserWithMfa()}.
	 * @param $context The parse tree.
	 */
	public function enterCreateUserWithMfa(Context\CreateUserWithMfaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::createUserWithMfa()}.
	 * @param $context The parse tree.
	 */
	public function exitCreateUserWithMfa(Context\CreateUserWithMfaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identification()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentification(Context\IdentificationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identification()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentification(Context\IdentificationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedByPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedByPassword(Context\IdentifiedByPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedByPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedByPassword(Context\IdentifiedByPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedByRandomPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedByRandomPassword(Context\IdentifiedByRandomPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedByRandomPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedByRandomPassword(Context\IdentifiedByRandomPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedWithPlugin()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedWithPlugin(Context\IdentifiedWithPluginContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedWithPlugin()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedWithPlugin(Context\IdentifiedWithPluginContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedWithPluginAsAuth()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedWithPluginAsAuth(Context\IdentifiedWithPluginAsAuthContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedWithPluginAsAuth()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedWithPluginAsAuth(Context\IdentifiedWithPluginAsAuthContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedWithPluginByPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedWithPluginByPassword(Context\IdentifiedWithPluginByPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedWithPluginByPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedWithPluginByPassword(Context\IdentifiedWithPluginByPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifiedWithPluginByRandomPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifiedWithPluginByRandomPassword(Context\IdentifiedWithPluginByRandomPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifiedWithPluginByRandomPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifiedWithPluginByRandomPassword(Context\IdentifiedWithPluginByRandomPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::initialAuth()}.
	 * @param $context The parse tree.
	 */
	public function enterInitialAuth(Context\InitialAuthContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::initialAuth()}.
	 * @param $context The parse tree.
	 */
	public function exitInitialAuth(Context\InitialAuthContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::retainCurrentPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterRetainCurrentPassword(Context\RetainCurrentPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::retainCurrentPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitRetainCurrentPassword(Context\RetainCurrentPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::discardOldPassword()}.
	 * @param $context The parse tree.
	 */
	public function enterDiscardOldPassword(Context\DiscardOldPasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::discardOldPassword()}.
	 * @param $context The parse tree.
	 */
	public function exitDiscardOldPassword(Context\DiscardOldPasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userRegistration()}.
	 * @param $context The parse tree.
	 */
	public function enterUserRegistration(Context\UserRegistrationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userRegistration()}.
	 * @param $context The parse tree.
	 */
	public function exitUserRegistration(Context\UserRegistrationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::factor()}.
	 * @param $context The parse tree.
	 */
	public function enterFactor(Context\FactorContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::factor()}.
	 * @param $context The parse tree.
	 */
	public function exitFactor(Context\FactorContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::replacePassword()}.
	 * @param $context The parse tree.
	 */
	public function enterReplacePassword(Context\ReplacePasswordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::replacePassword()}.
	 * @param $context The parse tree.
	 */
	public function exitReplacePassword(Context\ReplacePasswordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::userIdentifierOrText()}.
	 * @param $context The parse tree.
	 */
	public function enterUserIdentifierOrText(Context\UserIdentifierOrTextContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::userIdentifierOrText()}.
	 * @param $context The parse tree.
	 */
	public function exitUserIdentifierOrText(Context\UserIdentifierOrTextContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::user()}.
	 * @param $context The parse tree.
	 */
	public function enterUser(Context\UserContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::user()}.
	 * @param $context The parse tree.
	 */
	public function exitUser(Context\UserContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::likeClause()}.
	 * @param $context The parse tree.
	 */
	public function enterLikeClause(Context\LikeClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::likeClause()}.
	 * @param $context The parse tree.
	 */
	public function exitLikeClause(Context\LikeClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::likeOrWhere()}.
	 * @param $context The parse tree.
	 */
	public function enterLikeOrWhere(Context\LikeOrWhereContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::likeOrWhere()}.
	 * @param $context The parse tree.
	 */
	public function exitLikeOrWhere(Context\LikeOrWhereContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::onlineOption()}.
	 * @param $context The parse tree.
	 */
	public function enterOnlineOption(Context\OnlineOptionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::onlineOption()}.
	 * @param $context The parse tree.
	 */
	public function exitOnlineOption(Context\OnlineOptionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::noWriteToBinLog()}.
	 * @param $context The parse tree.
	 */
	public function enterNoWriteToBinLog(Context\NoWriteToBinLogContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::noWriteToBinLog()}.
	 * @param $context The parse tree.
	 */
	public function exitNoWriteToBinLog(Context\NoWriteToBinLogContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::usePartition()}.
	 * @param $context The parse tree.
	 */
	public function enterUsePartition(Context\UsePartitionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::usePartition()}.
	 * @param $context The parse tree.
	 */
	public function exitUsePartition(Context\UsePartitionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::fieldIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterFieldIdentifier(Context\FieldIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::fieldIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitFieldIdentifier(Context\FieldIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnName()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnName(Context\ColumnNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnName()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnName(Context\ColumnNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnInternalRef()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnInternalRef(Context\ColumnInternalRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnInternalRef()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnInternalRef(Context\ColumnInternalRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnInternalRefList()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnInternalRefList(Context\ColumnInternalRefListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnInternalRefList()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnInternalRefList(Context\ColumnInternalRefListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::columnRef()}.
	 * @param $context The parse tree.
	 */
	public function enterColumnRef(Context\ColumnRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::columnRef()}.
	 * @param $context The parse tree.
	 */
	public function exitColumnRef(Context\ColumnRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::insertIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterInsertIdentifier(Context\InsertIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::insertIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitInsertIdentifier(Context\InsertIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexName()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexName(Context\IndexNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexName()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexName(Context\IndexNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::indexRef()}.
	 * @param $context The parse tree.
	 */
	public function enterIndexRef(Context\IndexRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::indexRef()}.
	 * @param $context The parse tree.
	 */
	public function exitIndexRef(Context\IndexRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableWild()}.
	 * @param $context The parse tree.
	 */
	public function enterTableWild(Context\TableWildContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableWild()}.
	 * @param $context The parse tree.
	 */
	public function exitTableWild(Context\TableWildContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::schemaName()}.
	 * @param $context The parse tree.
	 */
	public function enterSchemaName(Context\SchemaNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::schemaName()}.
	 * @param $context The parse tree.
	 */
	public function exitSchemaName(Context\SchemaNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::schemaRef()}.
	 * @param $context The parse tree.
	 */
	public function enterSchemaRef(Context\SchemaRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::schemaRef()}.
	 * @param $context The parse tree.
	 */
	public function exitSchemaRef(Context\SchemaRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::procedureName()}.
	 * @param $context The parse tree.
	 */
	public function enterProcedureName(Context\ProcedureNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::procedureName()}.
	 * @param $context The parse tree.
	 */
	public function exitProcedureName(Context\ProcedureNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::procedureRef()}.
	 * @param $context The parse tree.
	 */
	public function enterProcedureRef(Context\ProcedureRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::procedureRef()}.
	 * @param $context The parse tree.
	 */
	public function exitProcedureRef(Context\ProcedureRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::functionName()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionName(Context\FunctionNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::functionName()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionName(Context\FunctionNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::functionRef()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionRef(Context\FunctionRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::functionRef()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionRef(Context\FunctionRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::triggerName()}.
	 * @param $context The parse tree.
	 */
	public function enterTriggerName(Context\TriggerNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::triggerName()}.
	 * @param $context The parse tree.
	 */
	public function exitTriggerName(Context\TriggerNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::triggerRef()}.
	 * @param $context The parse tree.
	 */
	public function enterTriggerRef(Context\TriggerRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::triggerRef()}.
	 * @param $context The parse tree.
	 */
	public function exitTriggerRef(Context\TriggerRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewName()}.
	 * @param $context The parse tree.
	 */
	public function enterViewName(Context\ViewNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewName()}.
	 * @param $context The parse tree.
	 */
	public function exitViewName(Context\ViewNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::viewRef()}.
	 * @param $context The parse tree.
	 */
	public function enterViewRef(Context\ViewRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::viewRef()}.
	 * @param $context The parse tree.
	 */
	public function exitViewRef(Context\ViewRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablespaceName()}.
	 * @param $context The parse tree.
	 */
	public function enterTablespaceName(Context\TablespaceNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablespaceName()}.
	 * @param $context The parse tree.
	 */
	public function exitTablespaceName(Context\TablespaceNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tablespaceRef()}.
	 * @param $context The parse tree.
	 */
	public function enterTablespaceRef(Context\TablespaceRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tablespaceRef()}.
	 * @param $context The parse tree.
	 */
	public function exitTablespaceRef(Context\TablespaceRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::logfileGroupName()}.
	 * @param $context The parse tree.
	 */
	public function enterLogfileGroupName(Context\LogfileGroupNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::logfileGroupName()}.
	 * @param $context The parse tree.
	 */
	public function exitLogfileGroupName(Context\LogfileGroupNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::logfileGroupRef()}.
	 * @param $context The parse tree.
	 */
	public function enterLogfileGroupRef(Context\LogfileGroupRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::logfileGroupRef()}.
	 * @param $context The parse tree.
	 */
	public function exitLogfileGroupRef(Context\LogfileGroupRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::eventName()}.
	 * @param $context The parse tree.
	 */
	public function enterEventName(Context\EventNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::eventName()}.
	 * @param $context The parse tree.
	 */
	public function exitEventName(Context\EventNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::eventRef()}.
	 * @param $context The parse tree.
	 */
	public function enterEventRef(Context\EventRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::eventRef()}.
	 * @param $context The parse tree.
	 */
	public function exitEventRef(Context\EventRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::udfName()}.
	 * @param $context The parse tree.
	 */
	public function enterUdfName(Context\UdfNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::udfName()}.
	 * @param $context The parse tree.
	 */
	public function exitUdfName(Context\UdfNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::serverName()}.
	 * @param $context The parse tree.
	 */
	public function enterServerName(Context\ServerNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::serverName()}.
	 * @param $context The parse tree.
	 */
	public function exitServerName(Context\ServerNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::serverRef()}.
	 * @param $context The parse tree.
	 */
	public function enterServerRef(Context\ServerRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::serverRef()}.
	 * @param $context The parse tree.
	 */
	public function exitServerRef(Context\ServerRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::engineRef()}.
	 * @param $context The parse tree.
	 */
	public function enterEngineRef(Context\EngineRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::engineRef()}.
	 * @param $context The parse tree.
	 */
	public function exitEngineRef(Context\EngineRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableName()}.
	 * @param $context The parse tree.
	 */
	public function enterTableName(Context\TableNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableName()}.
	 * @param $context The parse tree.
	 */
	public function exitTableName(Context\TableNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::filterTableRef()}.
	 * @param $context The parse tree.
	 */
	public function enterFilterTableRef(Context\FilterTableRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::filterTableRef()}.
	 * @param $context The parse tree.
	 */
	public function exitFilterTableRef(Context\FilterTableRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableRefWithWildcard()}.
	 * @param $context The parse tree.
	 */
	public function enterTableRefWithWildcard(Context\TableRefWithWildcardContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableRefWithWildcard()}.
	 * @param $context The parse tree.
	 */
	public function exitTableRefWithWildcard(Context\TableRefWithWildcardContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableRef()}.
	 * @param $context The parse tree.
	 */
	public function enterTableRef(Context\TableRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableRef()}.
	 * @param $context The parse tree.
	 */
	public function exitTableRef(Context\TableRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableRefList()}.
	 * @param $context The parse tree.
	 */
	public function enterTableRefList(Context\TableRefListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableRefList()}.
	 * @param $context The parse tree.
	 */
	public function exitTableRefList(Context\TableRefListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::tableAliasRefList()}.
	 * @param $context The parse tree.
	 */
	public function enterTableAliasRefList(Context\TableAliasRefListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::tableAliasRefList()}.
	 * @param $context The parse tree.
	 */
	public function exitTableAliasRefList(Context\TableAliasRefListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::parameterName()}.
	 * @param $context The parse tree.
	 */
	public function enterParameterName(Context\ParameterNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::parameterName()}.
	 * @param $context The parse tree.
	 */
	public function exitParameterName(Context\ParameterNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::labelIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterLabelIdentifier(Context\LabelIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::labelIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitLabelIdentifier(Context\LabelIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::labelRef()}.
	 * @param $context The parse tree.
	 */
	public function enterLabelRef(Context\LabelRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::labelRef()}.
	 * @param $context The parse tree.
	 */
	public function exitLabelRef(Context\LabelRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleIdentifier(Context\RoleIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleIdentifier(Context\RoleIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::pluginRef()}.
	 * @param $context The parse tree.
	 */
	public function enterPluginRef(Context\PluginRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::pluginRef()}.
	 * @param $context The parse tree.
	 */
	public function exitPluginRef(Context\PluginRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::componentRef()}.
	 * @param $context The parse tree.
	 */
	public function enterComponentRef(Context\ComponentRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::componentRef()}.
	 * @param $context The parse tree.
	 */
	public function exitComponentRef(Context\ComponentRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::resourceGroupRef()}.
	 * @param $context The parse tree.
	 */
	public function enterResourceGroupRef(Context\ResourceGroupRefContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::resourceGroupRef()}.
	 * @param $context The parse tree.
	 */
	public function exitResourceGroupRef(Context\ResourceGroupRefContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::windowName()}.
	 * @param $context The parse tree.
	 */
	public function enterWindowName(Context\WindowNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::windowName()}.
	 * @param $context The parse tree.
	 */
	public function exitWindowName(Context\WindowNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::pureIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterPureIdentifier(Context\PureIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::pureIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitPureIdentifier(Context\PureIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifier()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifier(Context\IdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifier()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifier(Context\IdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierList()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierList(Context\IdentifierListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierList()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierList(Context\IdentifierListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierListWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierListWithParentheses(Context\IdentifierListWithParenthesesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierListWithParentheses()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierListWithParentheses(Context\IdentifierListWithParenthesesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::qualifiedIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterQualifiedIdentifier(Context\QualifiedIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::qualifiedIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitQualifiedIdentifier(Context\QualifiedIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::simpleIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleIdentifier(Context\SimpleIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::simpleIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleIdentifier(Context\SimpleIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::dotIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterDotIdentifier(Context\DotIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::dotIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitDotIdentifier(Context\DotIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ulong_number()}.
	 * @param $context The parse tree.
	 */
	public function enterUlong_number(Context\Ulong_numberContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ulong_number()}.
	 * @param $context The parse tree.
	 */
	public function exitUlong_number(Context\Ulong_numberContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::real_ulong_number()}.
	 * @param $context The parse tree.
	 */
	public function enterReal_ulong_number(Context\Real_ulong_numberContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::real_ulong_number()}.
	 * @param $context The parse tree.
	 */
	public function exitReal_ulong_number(Context\Real_ulong_numberContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::ulonglongNumber()}.
	 * @param $context The parse tree.
	 */
	public function enterUlonglongNumber(Context\UlonglongNumberContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::ulonglongNumber()}.
	 * @param $context The parse tree.
	 */
	public function exitUlonglongNumber(Context\UlonglongNumberContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::real_ulonglong_number()}.
	 * @param $context The parse tree.
	 */
	public function enterReal_ulonglong_number(Context\Real_ulonglong_numberContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::real_ulonglong_number()}.
	 * @param $context The parse tree.
	 */
	public function exitReal_ulonglong_number(Context\Real_ulonglong_numberContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signedLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterSignedLiteral(Context\SignedLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signedLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitSignedLiteral(Context\SignedLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::signedLiteralOrNull()}.
	 * @param $context The parse tree.
	 */
	public function enterSignedLiteralOrNull(Context\SignedLiteralOrNullContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::signedLiteralOrNull()}.
	 * @param $context The parse tree.
	 */
	public function exitSignedLiteralOrNull(Context\SignedLiteralOrNullContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function enterLiteral(Context\LiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function exitLiteral(Context\LiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::literalOrNull()}.
	 * @param $context The parse tree.
	 */
	public function enterLiteralOrNull(Context\LiteralOrNullContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::literalOrNull()}.
	 * @param $context The parse tree.
	 */
	public function exitLiteralOrNull(Context\LiteralOrNullContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::nullAsLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterNullAsLiteral(Context\NullAsLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::nullAsLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitNullAsLiteral(Context\NullAsLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::stringList()}.
	 * @param $context The parse tree.
	 */
	public function enterStringList(Context\StringListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::stringList()}.
	 * @param $context The parse tree.
	 */
	public function exitStringList(Context\StringListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textStringLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterTextStringLiteral(Context\TextStringLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textStringLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitTextStringLiteral(Context\TextStringLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textString()}.
	 * @param $context The parse tree.
	 */
	public function enterTextString(Context\TextStringContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textString()}.
	 * @param $context The parse tree.
	 */
	public function exitTextString(Context\TextStringContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textStringHash()}.
	 * @param $context The parse tree.
	 */
	public function enterTextStringHash(Context\TextStringHashContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textStringHash()}.
	 * @param $context The parse tree.
	 */
	public function exitTextStringHash(Context\TextStringHashContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterTextLiteral(Context\TextLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitTextLiteral(Context\TextLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textStringNoLinebreak()}.
	 * @param $context The parse tree.
	 */
	public function enterTextStringNoLinebreak(Context\TextStringNoLinebreakContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textStringNoLinebreak()}.
	 * @param $context The parse tree.
	 */
	public function exitTextStringNoLinebreak(Context\TextStringNoLinebreakContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textStringLiteralList()}.
	 * @param $context The parse tree.
	 */
	public function enterTextStringLiteralList(Context\TextStringLiteralListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textStringLiteralList()}.
	 * @param $context The parse tree.
	 */
	public function exitTextStringLiteralList(Context\TextStringLiteralListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::numLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterNumLiteral(Context\NumLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::numLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitNumLiteral(Context\NumLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::boolLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterBoolLiteral(Context\BoolLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::boolLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitBoolLiteral(Context\BoolLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::nullLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterNullLiteral(Context\NullLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::nullLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitNullLiteral(Context\NullLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::int64Literal()}.
	 * @param $context The parse tree.
	 */
	public function enterInt64Literal(Context\Int64LiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::int64Literal()}.
	 * @param $context The parse tree.
	 */
	public function exitInt64Literal(Context\Int64LiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::temporalLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterTemporalLiteral(Context\TemporalLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::temporalLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitTemporalLiteral(Context\TemporalLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::floatOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterFloatOptions(Context\FloatOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::floatOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitFloatOptions(Context\FloatOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::standardFloatOptions()}.
	 * @param $context The parse tree.
	 */
	public function enterStandardFloatOptions(Context\StandardFloatOptionsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::standardFloatOptions()}.
	 * @param $context The parse tree.
	 */
	public function exitStandardFloatOptions(Context\StandardFloatOptionsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::precision()}.
	 * @param $context The parse tree.
	 */
	public function enterPrecision(Context\PrecisionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::precision()}.
	 * @param $context The parse tree.
	 */
	public function exitPrecision(Context\PrecisionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::textOrIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterTextOrIdentifier(Context\TextOrIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::textOrIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitTextOrIdentifier(Context\TextOrIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lValueIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function enterLValueIdentifier(Context\LValueIdentifierContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lValueIdentifier()}.
	 * @param $context The parse tree.
	 */
	public function exitLValueIdentifier(Context\LValueIdentifierContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleIdentifierOrText()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleIdentifierOrText(Context\RoleIdentifierOrTextContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleIdentifierOrText()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleIdentifierOrText(Context\RoleIdentifierOrTextContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::sizeNumber()}.
	 * @param $context The parse tree.
	 */
	public function enterSizeNumber(Context\SizeNumberContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::sizeNumber()}.
	 * @param $context The parse tree.
	 */
	public function exitSizeNumber(Context\SizeNumberContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::parentheses()}.
	 * @param $context The parse tree.
	 */
	public function enterParentheses(Context\ParenthesesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::parentheses()}.
	 * @param $context The parse tree.
	 */
	public function exitParentheses(Context\ParenthesesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::equal()}.
	 * @param $context The parse tree.
	 */
	public function enterEqual(Context\EqualContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::equal()}.
	 * @param $context The parse tree.
	 */
	public function exitEqual(Context\EqualContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::optionType()}.
	 * @param $context The parse tree.
	 */
	public function enterOptionType(Context\OptionTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::optionType()}.
	 * @param $context The parse tree.
	 */
	public function exitOptionType(Context\OptionTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::rvalueSystemVariableType()}.
	 * @param $context The parse tree.
	 */
	public function enterRvalueSystemVariableType(Context\RvalueSystemVariableTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::rvalueSystemVariableType()}.
	 * @param $context The parse tree.
	 */
	public function exitRvalueSystemVariableType(Context\RvalueSystemVariableTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::setVarIdentType()}.
	 * @param $context The parse tree.
	 */
	public function enterSetVarIdentType(Context\SetVarIdentTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::setVarIdentType()}.
	 * @param $context The parse tree.
	 */
	public function exitSetVarIdentType(Context\SetVarIdentTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::jsonAttribute()}.
	 * @param $context The parse tree.
	 */
	public function enterJsonAttribute(Context\JsonAttributeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::jsonAttribute()}.
	 * @param $context The parse tree.
	 */
	public function exitJsonAttribute(Context\JsonAttributeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeyword(Context\IdentifierKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeyword(Context\IdentifierKeywordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous1RolesAndLabels()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeywordsAmbiguous1RolesAndLabels(Context\IdentifierKeywordsAmbiguous1RolesAndLabelsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous1RolesAndLabels()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeywordsAmbiguous1RolesAndLabels(Context\IdentifierKeywordsAmbiguous1RolesAndLabelsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous2Labels()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeywordsAmbiguous2Labels(Context\IdentifierKeywordsAmbiguous2LabelsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous2Labels()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeywordsAmbiguous2Labels(Context\IdentifierKeywordsAmbiguous2LabelsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::labelKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterLabelKeyword(Context\LabelKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::labelKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitLabelKeyword(Context\LabelKeywordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous3Roles()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeywordsAmbiguous3Roles(Context\IdentifierKeywordsAmbiguous3RolesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous3Roles()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeywordsAmbiguous3Roles(Context\IdentifierKeywordsAmbiguous3RolesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeywordsUnambiguous()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeywordsUnambiguous(Context\IdentifierKeywordsUnambiguousContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeywordsUnambiguous()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeywordsUnambiguous(Context\IdentifierKeywordsUnambiguousContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleKeyword(Context\RoleKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleKeyword(Context\RoleKeywordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::lValueKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterLValueKeyword(Context\LValueKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::lValueKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitLValueKeyword(Context\LValueKeywordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous4SystemVariables()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierKeywordsAmbiguous4SystemVariables(Context\IdentifierKeywordsAmbiguous4SystemVariablesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::identifierKeywordsAmbiguous4SystemVariables()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierKeywordsAmbiguous4SystemVariables(Context\IdentifierKeywordsAmbiguous4SystemVariablesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleOrIdentifierKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleOrIdentifierKeyword(Context\RoleOrIdentifierKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleOrIdentifierKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleOrIdentifierKeyword(Context\RoleOrIdentifierKeywordContext $context): void;
	/**
	 * Enter a parse tree produced by {@see MySQLParser::roleOrLabelKeyword()}.
	 * @param $context The parse tree.
	 */
	public function enterRoleOrLabelKeyword(Context\RoleOrLabelKeywordContext $context): void;
	/**
	 * Exit a parse tree produced by {@see MySQLParser::roleOrLabelKeyword()}.
	 * @param $context The parse tree.
	 */
	public function exitRoleOrLabelKeyword(Context\RoleOrLabelKeywordContext $context): void;
}