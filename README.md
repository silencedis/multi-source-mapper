# MultiSourceMapper

## Concepts

### Expression
Each elementary configuration part is considered as an expression that will be interpreted.

### High-level expression
As any elementary configuration part, the whole mapped configuration is considered as an expression too.

### Command
An expression that represents an instruction for mapping.  
It may be defined in any format that is considered by at least one `ExpressionInstantiator`.  
Command may contain other commands in its instruction parts.